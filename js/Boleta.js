document.getElementById('download-btn').addEventListener('click', function() {
    var container = document.getElementById('printable');
    var clonedContainer = container.cloneNode(true);
    var head = document.head.cloneNode(true);

    var newWindow = window.open('', '_blank');
    var newDocument = newWindow.document;
    newDocument.head.appendChild(head);
    newDocument.body.appendChild(clonedContainer);
    var html = newDocument.documentElement.outerHTML;
    
    var blob = new Blob([html], { type: 'text/html' });
    var url = URL.createObjectURL(blob);

    var a = document.createElement('a');
    a.href = url;
    a.download = 'boleta_de_calificaciones.html';
    a.click();
});

document.getElementById('print-btn').addEventListener('click', function() {
    var container = document.getElementById('printable');
    var clonedContainer = container.cloneNode(true);
    var head = document.head.cloneNode(true);

    var newWindow = window.open('', '_blank');
    var newDocument = newWindow.document;
    newDocument.head.appendChild(head);
    newDocument.body.appendChild(clonedContainer);
    newWindow.print();
});
