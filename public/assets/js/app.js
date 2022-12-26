
  //live porfile image

  var loadFile = function(event) {
    var output = document.getElementById('getUserAvatar');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };


  $(function(){
    $(".fold-table tr.view").on("click", function(){
      $(this).toggleClass("open").next(".fold").toggleClass("open");
    });

   
  });




