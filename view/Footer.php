        <footer>
            Pied de page
        </footer>
    </body>
<?php
    if(isset($_GET['action'])) {
?>
    <script type="text/javascript">
        addAjaxListener("btnsubmit");
        changeAjaxListener("select_id");
        addAdresseListListener();
    </script>
<?php
    }
?>
</html>
