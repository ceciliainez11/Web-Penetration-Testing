<!DOCTYPE html>
<html>
    <head>
        <title>Search Engine</title>
    </head>

<body bgcolor="gray">
    <form action="insert_site.php" method="post" enctype="multipart/form-date">
        <table bgcolor="orange" width="500" border="2" cellspacing="2" allign="center">

            <tr>
                <td colspan="5" align="center"><h2>Inserting new website:</h2></td>
            </tr>

            <tr>
                <td align="right">Site Title:</td>
                <td><input type="text" name="site_title" /></td>
            </tr>

            <tr>
                <td align="right">Site Link:</td>
                <td><input type="text" name="site_link" /></td>
            </tr>

            <tr>
                <td align="right">Site Keywords:</td>
                <td><input type="text" name="site_keyword" /></td>
            </tr>

            <tr>
                <td align="right">Site Description:</td>
                <td><textarea cols="16" rows="8" name="site_desc"></textarea></td>
            </tr>

            <tr>
                <td align="right">Site Image:</td>
                <td><input type="text" name="site_image" /></td>
                <td align="center" colspan="5"><input type="submit" name="submit" value="Add site now"/></td>
            </tr>

        </table>
    </form>

</body>
</html>
