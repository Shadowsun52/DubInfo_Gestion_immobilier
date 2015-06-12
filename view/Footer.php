        <footer>
            © Développé par Dubinfo en 2015
        </footer>
    </body>
<?php
    if(isset($_GET['action'])) {
        if($_GET['action'] === 'gestion') {
?>
    <script type="text/javascript">
        addAjaxListener("btnsubmit");
        changeAjaxListener("select_id");
        addListCountryListener();
    </script>
<?php
        }
    }
?>
</html>
