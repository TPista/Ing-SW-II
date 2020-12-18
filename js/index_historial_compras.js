$(document).ready( function() {
  $('#mitabla').DataTable({
    "order": [[0, "asc"]],
    "language":{
      "processing":     "Procesando...",
        "lengthMenu":     "Mostrar _MENU_ registros",
        "zeroRecords":    "No has comprado ningun producto!",
        "sEmptyTable":     "No has comprado ningun producto!",
        "info":           "Compraste un total de _TOTAL_ producto(s)",
        "infoEmpty":      "No compraste ningun producto!",
        "infoFiltered":   "",
        "search":         "Buscar:",
        "loadingRecords": "Cargando...",
        "paginate": {
          "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "buttons": {
            "pageLength": {
                "_": "Mostrar %d filas",
                "-1": "Mostrar Todo"
            }
        }
    },
    "iDisplayLength": -1,
    "lengthMenu": [[10,25,50, -1],[10,25,50,"Mostrar Todo"]],
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": "mostrar_historial_compras.php",
    dom: 'Bifrtp',
    buttons: {
        dom: {
            container:{
                tag:'div',
                className:'flexcontent'
            },
            buttonLiner: {
                tag: null
            }
        },
        buttons:[
        {
            extend:    'pdfHtml5',
            text:      '<i class="fa fa-file-pdf"></i>PDF',
            title:     'Historial de Compras (PDF)',
            titleAttr: 'PDF',
            className: 'btn btn-app export pdf',
            exportOptions: {
                columns: [ 0, 1, 2, 3 ]
            },
            customize:function(doc) {
                doc.styles.title = {
                    color: '#4c8aa0',
                    fontSize: '30',
                    alignment: 'center'
                },
                doc.styles['td:nth-child(2)'] = {
                    width: '100px',
                    'max-width': '100px'
                },
                doc.styles.tableHeader = {
                    fillColor:'#4c8aa0',
                    color:'white',
                    alignment:'center'
                },
                doc.content[1].margin = [ 100, 0, 100, 0 ]
            }
        },
        {
            extend:    'excelHtml5',
            text:      '<i class="fa fa-file-excel"></i>Excel',
            title:     'Historial de Compras (Excel)',
            titleAttr: 'Excel',
            className: 'btn btn-app export excel',
            exportOptions: {
                columns: [ 0, 1, 2, 3 ]
            },
        },
        {
            extend:    'csvHtml5',
            text:      '<i class="fa fa-file-csv"></i>CSV',
            title:     'Historial de Compras (CSV)',
            titleAttr: 'CSV',
            className: 'btn btn-app export csv',
            exportOptions: {
                columns: [ 0, 1, 2, 3 ]
            }
        },
        {
            extend:    'print',
            text:      '<i class="fa fa-print"></i>Imprimir',
            title:     'Historial de Compras',
            titleAttr: 'Imprimir',
            className: 'btn btn-app export imprimir',
            exportOptions: {
                columns: [ 0, 1, 2, 3 ]
            }
        },
        {
            extend:    'pageLength',
            titleAttr: 'Registros a mostrar',
            className: 'selectTable'
        }
      ]
    }
  });
});