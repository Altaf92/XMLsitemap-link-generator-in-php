<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitemap</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

   <div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-8">
        <form action="result.php" method="post">
        <div class="mb-3">
            <label class="form-label">Enter Website Link</label>
            <input type="text" name="link" class="form-control" require placeholder="Enter website link to genetate sitemap links">
        </div>

        <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>

    </form>
        </div>
    </div>
   </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>