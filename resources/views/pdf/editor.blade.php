<html>
<head>
    <title>PDF Editor</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.6.0/fabric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        canvas { border: 1px solid #ccc; margin-top: 10px; }
        .toolbar { margin-bottom: 10px; }
        .page-controls { margin-top: 15px; }
    </style>
</head>
<body>
    <h2>PDF एडिटर</h2>
    <div class="toolbar">
        <button onclick="addText()">Add Text</button>
        <button onclick="enableDraw()">Draw</button>
        <button onclick="disableDraw()">Stop Draw</button>
        <button onclick="enableErase()">Erase</button>
        <button onclick="clearCanvas()">Clear All</button>
        <button onclick="zoomIn()">Zoom In</button>
        <button onclick="zoomOut()">Zoom Out</button>
        <button onclick="savePDF()">Download</button>
    </div>
    <div class="page-controls">
        <button onclick="prevPage()">Previous Page</button>
        <span>Page <span id="page-num">1</span> / <span id="page-count">?</span></span>
        <button onclick="nextPage()">Next Page</button>
    </div>
    <canvas id="pdf-canvas"></canvas>

    <script>
        const url = "{{ url($pdfUrl) }}";
        const canvasEl = document.getElementById('pdf-canvas');
        const fabricCanvas = new fabric.Canvas('pdf-canvas');

        let currentPage = 1;
        let totalPages = 0;
        let pdfDoc = null;
        let currentZoom = 1.5;

        function renderPage(num) {
            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({ scale: currentZoom });
                const canvasContext = canvasEl.getContext('2d');

                canvasEl.height = viewport.height;
                canvasEl.width = viewport.width;

                const renderContext = {
                    canvasContext: canvasContext,
                    viewport: viewport
                };

                page.render(renderContext).promise.then(() => {
                    const bgImg = canvasEl.toDataURL('image/png');
                    fabricCanvas.clear();
                    fabricCanvas.setWidth(viewport.width);
                    fabricCanvas.setHeight(viewport.height);
                    fabric.Image.fromURL(bgImg, (img) => {
                        fabricCanvas.setBackgroundImage(img, fabricCanvas.renderAll.bind(fabricCanvas));
                    });
                });

                document.getElementById('page-num').textContent = num;
            });
        }

        pdfjsLib.getDocument(url).promise.then(pdf => {
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            document.getElementById('page-count').textContent = totalPages;
            renderPage(currentPage);
        });

        function prevPage() {
            if (currentPage <= 1) return;
            currentPage--;
            renderPage(currentPage);
        }

        function nextPage() {
            if (currentPage >= totalPages) return;
            currentPage++;
            renderPage(currentPage);
        }

        function addText() {
            const text = new fabric.IText('Edit me', {
                left: 100,
                top: 100,
                fill: 'black'
            });
            fabricCanvas.add(text);
        }

        function enableDraw() {
            fabricCanvas.isDrawingMode = true;
            fabricCanvas.freeDrawingBrush.color = "black";
            fabricCanvas.freeDrawingBrush.width = 2;
        }

        function disableDraw() {
            fabricCanvas.isDrawingMode = false;
        }

        function enableErase() {
            fabricCanvas.isDrawingMode = true;
            fabricCanvas.freeDrawingBrush = new fabric.EraserBrush(fabricCanvas);
            fabricCanvas.freeDrawingBrush.width = 10;
        }

        function clearCanvas() {
            fabricCanvas.getObjects().forEach(obj => {
                if (obj !== fabricCanvas.backgroundImage) fabricCanvas.remove(obj);
            });
        }

        function zoomIn() {
            currentZoom += 0.2;
            renderPage(currentPage);
        }

        function zoomOut() {
            if (currentZoom > 0.5) {
                currentZoom -= 0.2;
                renderPage(currentPage);
            }
        }

        function savePDF() {
            const imgData = fabricCanvas.toDataURL({ format: 'png' });
            const doc = new jspdf.jsPDF({ orientation: 'portrait', unit: 'px', format: [canvasEl.width, canvasEl.height] });
            doc.addImage(imgData, 'PNG', 0, 0);
            doc.save('edited_page_' + currentPage + '.pdf');
        }
    </script>
</body>
</html>