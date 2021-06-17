<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}</title>

	<style>
		.invoice-box {
			max-width: 800px;
			margin: auto;
			padding: 30px;
			border: 1px solid #eee;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
			font-size: 16px;
			line-height: 24px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
		}

		.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
		}

		.invoice-box table td {
			padding: 5px;
			vertical-align: top;
		}

		.invoice-box table tr td:nth-child(2) {
			text-align: right;
		}

		.invoice-box table tr.top table td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
		}

		.invoice-box table tr.information table td {
			padding-bottom: 40px;
		}

		.invoice-box table tr.heading td {
			background: #eee;
			border-bottom: 1px solid #ddd;
			font-weight: bold;
		}

		.invoice-box table tr.details td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.item td {
			border-bottom: 1px solid #eee;
		}

		.invoice-box table tr.item.last td {
			border-bottom: none;
		}

		.invoice-box table tr.total td:nth-child(2) {
			border-top: 2px solid #eee;
			font-weight: bold;
		}

		@media only screen and (max-width: 600px) {
			.invoice-box table tr.top table td {
				width: 100%;
				display: block;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 100%;
				display: block;
				text-align: center;
			}
		}

		/** RTL **/
		.rtl {
			direction: rtl;
			font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		}

		.rtl table {
			text-align: right;
		}

		.rtl table tr td:nth-child(2) {
			text-align: left;
		}
	</style>
</head>

<body>
<div class="invoice-box">
	<table cellpadding="0" cellspacing="0">
		<tr class="top">
			<td colspan="2">
				<table>
					<tr>
						<td class="title">
							<a href="{{Auth::user()->tenant->website ?? 'https://www.cnx247.com'}}" class="f-fallback email-masthead_name" style="color: #A8AAAF; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
								<img class="img-fluid ml-5 mt-3" src="{{asset('/assets/images/company-assets/logos/'.Auth::user()->tenant->logo ?? 'logo.png')}}" alt="{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}" style="width: 100%; max-width: 300px" >
							</a>
						</td>

						<td>
							Invoice #: 123<br />
							Created: {{date('d F, Y', strtotime($invoice->issue_date))}}<br />
							Due: {{date('d F, Y', strtotime($invoice->due_date))}}
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr class="information">
			<td colspan="2">
				<table>
					<tr>
						<td>
							{{Auth::user()->tenant->company_name ?? 'CNX247 ERP Solution'}}<br />
							{{Auth::user()->tenant->street_1 ?? 'Street here'}} <br />
							{{ Auth::user()->tenant->city ?? ''}} {{Auth::user()->tenant->postal_code ?? 'Postal code here'}}
						</td>

						<td>
							{{$invoice->client->company_name ?? $invoice->client->first_name }}<br />
							{{$invoice->client->first_name ?? '' }} {{$invoice->client->surname ?? '' }}<br />
							{{$invoice->client->email ?? '' }}
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="heading">
			<td>Item</td>
			<td>Qty</td>
			<td>Unit Cost</td>
			<td>Amount</td>
		</tr>
		@foreach ($invoice->invoiceItem as $item)
			<tr class="item">
				<td>{{$item->description}}</td>
				<td class="float-right" style="text-align: center">{{number_format($item->quantity)}}</td>
				<td class="float-right">{{number_format($item->unit_cost, 2)}}</td>
				<td class="float-right">{{number_format($item->quantity * $item->unit_cost,2)}}</td>
			</tr>
		@endforeach
		<tr class="total">
			<td></td>
			<td></td>
			<td></td>
			<td class="float-right">Sub-total: {{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($invoice->sub_total,2)}}</td>
		</tr>
		<tr class="total">
			<td></td>
			<td></td>
			<td></td>
			<td class="float-right">Tax({{$invoice->tax_rate}}%): {{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($invoice->tax_value,2) ?? 0}}</td>
		</tr>
		<tr class="total">
			<td></td>
			<td></td>
			<td></td>
			<td class="float-right">Total: {{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($invoice->total,2)}}</td>
		</tr>
	</table>
</div>
</body>
</html>
