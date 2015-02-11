<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<link href="css/datepicker.css" rel="stylesheet" type="text/css">

<!-- Load jQuery and bootstrap datepicker scripts -->
 <script src="js/bootstrap-datepicker.js"></script>
 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                $('.date_pic').datepicker({
                format: "yyyy/mm/dd"
             });
	});  	
</script>

<input name="Date"  type="text"  class="date_pic">