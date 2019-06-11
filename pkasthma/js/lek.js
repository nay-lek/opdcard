    $(document).ready(function() {
      $('.datatable').DataTable({
            "bAutoWidth": false,
           "bSort": false
       
          
      });


      $('input').not('input[type=submit]').addClass('form-control');
      $('.view-druguse').click(function(){

            var items1 = $(this).attr('data-items1');
            var items2 = $(this).attr('data-items2');
            var items3 = $(this).attr('data-items3');
            var items4 = $(this).attr('data-items4');
            var items5 = $(this).attr('data-items5');
            var items6 = $(this).attr('data-items6');
            var items7 = $(this).attr('data-items7');
            var items8 = $(this).attr('data-items8');
            var items9 = $(this).attr('data-items9');
            var vvstdate = $(this).attr('data-vvst'); 
            var ptname = $(this).attr('data-ptname'); 


      		$('#items1').val(items1);
      		$('#items2').val(items2);
      		$('#items3').val(items3);
      		$('#items4').val(items4);
      		$('#items5').val(items5);
      		$('#items6').val(items6);
      		$('#items7').val(items7);
      		$('#items8').val(items8);
      		$('#items9').val(items9);
          $('#vvstdate').val(vvstdate);
          $('#ptname').val(ptname);

      		$('#vieeScroeGruguse').modal('show');
      });
    } );