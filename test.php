<html>
  <head>
  <script type="text/javascript">
    function updateTextInput(val) {
      document.getElementById('cas').value=val; 
    }
  </script>
  </head>
  <body>
    <input type="range" name="rangeInput" min="0" max="100" onchange="updateTextInput(this.value);">                                                       
    <input type="number" id="cas" name="cas" value="">
  </body>
</html>