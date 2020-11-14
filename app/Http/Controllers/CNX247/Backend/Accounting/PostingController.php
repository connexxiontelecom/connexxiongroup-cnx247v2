<?php

namespace App\Http\Controllers\CNX247\Backend\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Invoice;
use App\Receipt;
use App\Client;
use App\ReceiptItem;
use App\InvoiceItem;
use App\DefaultAccount;
use Carbon\Carbon;
use Auth;
use DB;
use Schema;

class PostingController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function receipt(){
        $receipts = Receipt::where('tenant_id', Auth::user()->tenant_id)
        ->where('posted',0)->where('trash',0)->get();
        return view('backend.accounting.postings.receipt', ['receipts'=>$receipts]);
    }

    public function invoice(){
        $invoices = Invoice::where('posted', 0)->where('trash', 0)->where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.accounting.postings.invoice', ['invoices'=>$invoices]);
    }

    public function receiptDetail($slug){

        $receipt = Receipt::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($receipt)){

            return view('backend.accounting.postings.receipt-detail', ['receipt'=>$receipt]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return back();
        }
    }
    public function postReceipt($slug)
    {
        $receipt = Receipt::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if (!empty($receipt)) {
            $receipt->posted = 1;
            $receipt->date_posted = now();
            $receipt->save();
            //$invoiceGL = DefaultAccount::where('handle', 'invoice')->where('tenant_id', Auth::user()->tenant_id)->first();
            $client = Client::where('tenant_id', Auth::user()->tenant_id)->where('id', $receipt->client_id)->first();
            //$receiptGL = DefaultAccount::where('handle', 'receipt')->where('tenant_id', Auth::user()->tenant_id)->first();
            $detail = ReceiptItem::where('receipt_id', $receipt->id)->where('tenant_id', Auth::user()->tenant_id)->get();
            # Post to GL
            $bankGl = [
                'glcode' => $receipt->bank,
                'posted_by' => Auth::user()->id,
                'narration' => 'Payment received from ' . $receipt->client->first_name ?? '',
                'dr_amount' => $receipt->amount,
                'cr_amount' => 0,
                'ref_no' => $receipt->ref_no ?? '',
                'bank' => 0,
                'ob' => 0,
                'posted' => 1,
                'created_at' => $receipt->issue_date,
                'transaction_date' => $receipt->issue_date
            ];
            DB::table(Auth::user()->tenant_id . '_gl')->insert($bankGl);
            foreach ($detail as $d) {
                //$items = InvoiceItem::where('invoice_id', $d->invoice_id)->get();
               // foreach($items as $item){
                    $customerGl = [
                        'glcode' => $client->glcode,
                        'posted_by' => Auth::user()->id,
                        'narration' => 'Payment received for Invoice #: '.$d->invoice_id,
                        'dr_amount' => 0,
                        'cr_amount' => $d->payment ?? 0,
                        'ref_no' => $receipt->ref_no ?? '',
                        'bank' => 0,
                        'ob' => 0,
                        'posted' => 1,
                        'created_at' => $receipt->issue_date,
                        'transaction_date' => $receipt->issue_date
                    ];
                    DB::table(Auth::user()->tenant_id . '_gl')->insert($customerGl);
                //}
            }
            session()->flash("success", "<strong>Success!</strong> Receipt posted.");
            return redirect()->route('receipt-posting');
        }
    }
}
