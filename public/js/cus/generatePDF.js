import jspdf from '/';

function generatePDF(){
	const doc = new jsPDF();
	doc.text("Hello world!", 10, 10);
	doc.save("a4.pdf");
}