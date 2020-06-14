<footer class="app-footer">
      <div class="row">
        <div class="col-xs-12">
          <div class="footer-copyright">Copyright © <?php echo date('Y');?> <a href="http://www.viaviweb.com" target="_blank">Viaviweb.com</a>. All Rights Reserved.</div>
        </div>
      </div>
    </footer>
  </div>
</div>
<script type="text/javascript" src="assets/js/vendor.js"></script> 
<script type="text/javascript" src="assets/js/app.js"></script>

<!-- For Bootstrap Tags -->
<script type="text/javascript" src="assets/bootstrap-tag/bootstrap-tagsinput.js"></script>
<!-- End -->

<script type="text/javascript">
	$("input").val()
</script>

<script>
	$("#checkall").click(function () {
		$("input:checkbox[name='wall_ids[]']").not(this).prop('checked', this.checked);
	});
</script>    


</body>
</html>