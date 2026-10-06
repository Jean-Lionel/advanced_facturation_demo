(function ($, window) {
    if (!$ || !$.fn || !$.fn.dataTable || !$.fn.dataTable.ext) {
        return;
    }

    var buttons = $.fn.dataTable.ext.buttons;

    function mapButton(alias, target, text) {
        if (!buttons[target]) {
            return;
        }

        buttons[alias] = $.extend(true, {}, buttons[target], {
            text: text
        });
    }

    mapButton('copy', 'copyHtml5', 'Copier');
    mapButton('csv', 'csvHtml5', 'CSV');
    mapButton('excel', 'excelHtml5', 'Excel');
    mapButton('pdf', 'pdfHtml5', 'PDF');

    function escapeHtml(value) {
        return $('<div>').text(value === null || value === undefined ? '' : value).html();
    }

    function buildRows(rows, tag) {
        return rows.map(function (row) {
            return '<tr>' + row.map(function (cell) {
                return '<' + tag + '>' + escapeHtml(cell) + '</' + tag + '>';
            }).join('') + '</tr>';
        }).join('');
    }

    function printDataTable(dt, config) {
        var data = dt.buttons.exportData(config.exportOptions || {});
        var title = config.title || document.title || 'Impression';
        var iframe = document.createElement('iframe');
        var styles = [
            'body{font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#111;margin:20px;}',
            'h1{font-size:18px;text-align:center;margin:0 0 16px;}',
            'table{width:100%;border-collapse:collapse;}',
            'th,td{border:1px solid #444;padding:5px;text-align:left;vertical-align:top;}',
            'th{background:#f2f2f2;font-weight:bold;}',
            '@page{size:auto;margin:12mm;}'
        ].join('');
        var html = [
            '<!doctype html><html><head><meta charset="utf-8">',
            '<title>', escapeHtml(title), '</title>',
            '<style>', styles, '</style>',
            '</head><body>',
            '<h1>', escapeHtml(title), '</h1>',
            '<table><thead>',
            buildRows([data.header], 'th'),
            '</thead><tbody>',
            buildRows(data.body, 'td'),
            '</tbody>',
            data.footer && data.footer.length ? '<tfoot>' + buildRows([data.footer], 'th') + '</tfoot>' : '',
            '</table>',
            '</body></html>'
        ].join('');

        iframe.style.position = 'fixed';
        iframe.style.right = '0';
        iframe.style.bottom = '0';
        iframe.style.width = '0';
        iframe.style.height = '0';
        iframe.style.border = '0';

        document.body.appendChild(iframe);
        iframe.contentDocument.open();
        iframe.contentDocument.write(html);
        iframe.contentDocument.close();

        setTimeout(function () {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();

            setTimeout(function () {
                if (iframe.parentNode) {
                    iframe.parentNode.removeChild(iframe);
                }
            }, 1000);
        }, 250);
    }

    buttons.print = {
        text: 'Imprimer',
        className: 'buttons-print',
        action: function (e, dt, button, config) {
            printDataTable(dt, config || {});
        }
    };

    if (window.pdfMake && !window.pdfMake.vfs) {
        delete buttons.pdf;
    }
})(window.jQuery, window);
