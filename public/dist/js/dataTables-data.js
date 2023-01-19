/*DataTable Init*/

"use strict";

$(document).ready(function() {
	/*PIMIS DataTable*/
	$('#agentTab').DataTable( {
		dom: 'Bfrtip',
		responsive: true,
        lengthChange: false,
		"bPaginate": true,
		"info":     false,
		"bFilter":     true,
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		"drawCallback": function () {
			$('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
		}
	} );


    $('#userTab').DataTable( {
		dom: 'Bfrtip',
		responsive: true,
        lengthChange: false,
		"bPaginate": true,
		"info":     false,
		"bFilter":     true,
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		"drawCallback": function () {
			$('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
		}
	} );

    $('#bailleurTab').DataTable( {
		dom: 'Bfrtip',
		responsive: true,
        lengthChange: false,
		"bPaginate": true,
		"info":     false,
		"bFilter":     true,
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		"drawCallback": function () {
			$('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
		}
	} );

    $('#projetTab').DataTable( {
		dom: 'Bfrtip',
		responsive: true,
        lengthChange: false,
		"bPaginate": true,
		"info":     false,
		"bFilter":     true,
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		"drawCallback": function () {
			$('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
		}
	} );

    $('#affectationTab').DataTable( {
		dom: 'Bfrtip',
		responsive: true,
        lengthChange: false,
		"bPaginate": true,
		"info":     false,
		"bFilter":     true,
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		"drawCallback": function () {
			$('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
		}
	} );

    $('#productTab').DataTable( {
		dom: 'Bfrtip',
		responsive: true,
        lengthChange: false,
		"bPaginate": true,
		"info":     false,
		"bFilter":     true,
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		"drawCallback": function () {
			$('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
		}
	} );

    $('#etBesTab').DataTable( {
		dom: 'Bfrtip',
		responsive: true,
        lengthChange: false,
		"bPaginate": true,
		"info":     false,
		"bFilter":     true,
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		"drawCallback": function () {
			$('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
		}
	} );

    $('#categorieTab').DataTable( {
		responsive: true,
        lengthChange: false,
		"bPaginate": true,
		"info":     false,
		"bFilter":     true
	} );


    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
} );
