<?php
//echo "<pre>";
//var_dump($result);
//echo "</pre>";
//exit;
//?>


<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand mb-0 h1" href="/">Wayback Search</a>
    </div>
</nav>

<?php if (isset($result)){ ?>
        <div class="container mt-5">
            <div class="alert alert-success" role="alert">
                <div class="row">
                    <h4>Result: </h4>
                    <div class="input-group">
                        <input type="text" name="url" class="form-control" id="copy" placeholder="" value="<?php echo $result; ?>">
                        <button class="btn btn-secondary" onclick="copy()">Copy</button>
                    </div>
                </div>

            </div>
        </div>
<?php } ?>

<div class="container my-5">
    <div class="card p-4">
        <form action="/url-create" method="post">
            <div class="mb-3">
                <h4>URL</h4>
                <hr>
                <div class="input-group">
                    <input type="text" name="url" class="form-control" id="url" placeholder="example: domain.com/path/path">
                    <button class="btn btn-secondary" name="submit" type="submit" id="button-addon2">Search</button>
                </div>
            </div>
            <div class="row mt-4">
                <h4> Filters </h4><hr>
                <div class="col">
                    <label for="" class="form-label">Output</label>
                    <select class="form-select" name="output" aria-label="Default select example">
                        <option value="txt" selected>Text</option>
                        <option value="pdf">PDF</option>
                        <option value="xml">XML</option>
                    </select>
                </div>
                <div class="col">
                    <label for="" class="form-label">Show</label>
                    <select class="form-select" name="fl" aria-label="Default select example">
                        <option value="" selected>All</option>
                        <option value="original">Original</option>
                    </select>
                </div>
                <div class="col">
                    <label for="" class="form-label">Status</label>
                    <select class="form-select" name="status" aria-label="Default select example">
                        <option value="202" selected>200</option>
                        <option value="404">404</option>
                    </select>
                </div>
                <div class="col">
                    <label for="" class="form-label">Limit</label>
                    <select class="form-select" name="limit" aria-label="Default select example">
                        <option value="0" selected>Limitless</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                    </select>
                </div>
                <div class="col">
                    <label for="" class="form-label">Collapse</label>
                    <select class="form-select" name="collapse" aria-label="Default select example">
                        <option value="urlkey">urlkey</option>
                        <option value="timestamp">timestamp</option>
                        <option value="field">field</option>
                    </select>
                </div>
            </div>
            <div class="row mt-4">
                <h4> Timestamp </h4><hr>
                <div class="col">
                    <label for="" class="form-label">Timestamp (default: none)</label>
                    <input type="text" name="timestamp" class="form-control" placeholder="example for 2020-01-13: 20200113">
                </div>
            </div>
            <!--        <div class="row mt-4">-->
            <!--            <div class="col">-->
            <!--                <label for="" class="form-label">Timestamp Range Start (default: none)</label>-->
            <!--                <input type="text" name="timestamp-range-start" class="form-control" placeholder="example for 2020-01-13: 20200113">-->
            <!--            </div>-->
            <!--            <div class="col">-->
            <!--                <label for="" class="form-label">Timestamp Range End (default: none)</label>-->
            <!--                <input type="text" name="timestamp-range-start" class="form-control" placeholder="example for 2020-01-13: 20200113">-->
            <!--            </div>-->
            <!--        </div>-->
        </form>
    </div>
    <div class="card p-4 mt-4">
        <div class="row">
            <h4>List</h4>
            <hr>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Link</th>
                </tr>
                </thead>
                <tbody>
                    <?php if (isset($api_result)){ $counter = 1; ?>
                        <?php foreach ($api_result as $data){ ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td class="text-break"><a href="<?php echo $data; ?>"><?php echo $data; ?></a> </td>
                            </tr>
                        <?php $counter++; }?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function copy() {
        /* Get the text field */
        var copyText = document.getElementById("copy");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

    }
</script>
