     <script src="<?php echo base_url('') ?>assets/js/bootstrap.min.js"></script>
          <script type="text/javascript">
              $(".js-example-basic-multiple").select2();
          </script>
          <script type="text/javascript">
            var modal = document.getElementById('myModal');
            var btn = document.getElementById("myBtn");
            var span = document.getElementsByClassName("close")[0];
            btn.onclick = function() {
                modal.style.display = "block";
            }
            span.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }      
          </script>
          <script type="text/javascript">
             $(document).ready(function(){
             $('#example').DataTable();
          });
          </script>
          <script>
              function myFunction() {
              // Declare variables 
              var input, filter, table, tr, td, i;
              input = document.getElementById("myInput");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");

              // Loop through all table rows, and hide those who don't match the search query
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];

                if (td) {
                  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                } 
              }
            }
          </script>
          <script>
              function myFunction2() {
              // Declare variables 
              var input, filter, table, tr, td, i;
              input = document.getElementById("myInput2");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable2");
              tr = table.getElementsByTagName("tr");

              // Loop through all table rows, and hide those who don't match the search query
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];

                if (td) {
                  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                } 
              }
            }
          </script>
          <script>
              var slideIndex = 1;
              showDivs(slideIndex);

              function plusDivs(n) {
                  showDivs(slideIndex += n);
              }

              function showDivs(n) {
                  var i;
                  var x = document.getElementsByClassName("mySlides");
                  if (n > x.length) {slideIndex = 1} 
                      if (n < 1) {slideIndex = x.length} ;
                          for (i = 0; i < x.length; i++) {
                              x[i].style.display = "none"; 
                          }
                      slideIndex++;
                      if (slideIndex > x.length) {slideIndex = 1} 
                      x[slideIndex-1].style.display = "block"; 
                      setTimeout(showDivs, 2000); 
                  }
        </script>
        <script>
        $(document).ready(function(){
          function setCurrency (currency) {
              if (!currency.id) { return currency.text; }
                var $currency = $('<span class="glyphicon glyphicon-' + currency.element.value + '">' + currency.text + '</span>');
                return $currency;
            };
            $(".templatingSelect2").select2({
                placeholder: "What currency do you use?", //placeholder
                templateResult: setCurrency,
                templateSelection: setCurrency
            });
        })
      </script>
      <style>
        .demo-section label {
            display: block;
            margin: 15px 0 5px 0;
        }
        #get {
            float: right;
            margin: 25px auto 0;
        }

      </style>
      <script>
        $(document).ready(function() {
            var required = $("#required").kendoMultiSelect().data("kendoMultiSelect");
            var optional = $("#optional").kendoMultiSelect({
                autoClose: true,
                maxSelectedItems: 1,
            }).data("kendoMultiSelect");
            var optional2 = $("#optional2").kendoMultiSelect({
                autoClose: true,
                maxSelectedItems: 1,
            }).data("kendoMultiSelect");

            $("#get").click(function() {
                alert("Attendees:\n\nRequired: " + required.value() + "\nOptional: " + optional.value());
            });
        });
      </script>
      <script type="text/javascript">
          $(document).ready(function() {
            $(".js-example-basic-single").select2();
          });
      </script>
      <script>
         $(document).ready(function() {
             $("#files").kendoUpload();
            });
      </script>
  </body>
</html>