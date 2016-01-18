<!DOCTYPE html>
<yield:functions/>
<html>
<head>
    <block:head>
        <title>${title}</title>
        <script>
            window.csrfToken = "<?= spiral('request')->getAttribute('csrfToken') ?>";
        </script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width">

        <block:resources/>
        <!--[STYLES]-->
    </block:head>
</head>
<body>
<yield:body/>
<!--[SCRIPTS]-->
</body>
</html>