<?php
 include "db.php";
 $filterOption = $_POST['filterOption'];
 //$customnumber=$_POST['customnumber'];
 //$customnumber='-'.$customnumber;
if ($filterOption != 'favorite' && $filterOption != 'indexes' && $filterOption!='efts' && $filterOption!='crypto') {
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<style>
    .navbar {
    background-image: linear-gradient(to right, #383838, #383838);
    position: fixed;
    width: 100%;
    z-index: 999;
}

    .bg-warning {
        background-color: #f5be19 !important;
    }
    .bg-danger, .bg-success, .bg-warning {
        color: white !important;
        font-weight: 500;
    }
    thead {
        font-size: 13px;
    }
    table {
        text-align: center;
    }
    .cname1 {
        text-align: left !important;
        vertical-align: middle !important;
    }
    .cname {
        text-align: left !important;
    position: relative; /* Establish a positioning context for absolute positioning */
    padding-right: 20px; /* Add padding to the right for the icon */
}

.heart-icon {
    position: absolute; /* Position the heart icon absolutely */
    right: 3px; /* Align it to the right of the cell */
    top: 50%; /* Center vertically */
    transform: translateY(-50%); /* Adjust to perfect vertical centering */
    color: red; /* Optional: Set the color of the heart icon */
}
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #E6E6B1;
    }
    table.dataTable tbody tr {
        background-color: #FFFFC5;
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 9px 2px;
        border-bottom: 1px solid #111;
    }
    table.dataTable thead .sorting {
        background-image: none;
    }    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #FFFFC5;
    }  
    @media (max-width: 768px) {
        .hidemobile {
            display: none;
        }
        thead, table {
            font-size: 10px;
        }
        table.dataTable thead th {
            padding-right: 15px; /* Add padding to the right of header cells */
        }
        table.dataTable thead th.sorting:after, 
        table.dataTable thead th.sorting_asc:after, 
        table.dataTable thead th.sorting_desc:after {
            margin-left: 5px; /* Adjust the margin between text and arrow */
        }
    }
    .table-striped>tbody>tr:nth-of-type(odd)>* {
        --bs-table-accent-bg: rgb(0 0 0 / 0%)!important;
        border-bottom: 1px solid #e7e7e7;
        color: var(--bs-table-striped-color);
        text-align: center;
    }
    table.dataTable tbody th, table.dataTable tbody td {
        border-bottom: 1px solid #e7e7e7;
        color: var(--bs-table-striped-color);
        text-align: center;
    }
    .heart-icon {
        cursor: pointer;
        margin-right: 12px;
        color: #000;
        font-size: 20px;
    }

    .heart-icon.favorited {
        font-size: 20px;
        color: #000;

    }
    @media (max-width: 768px) {
        .hidemobile {
            display: none;
        }}
</style>

<table id="stockTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="cname1" data-column="name" width="25%">Company</th>
            <th class="hidemobile" data-column="marketCap">Market Cap ($B)</th>
            <th data-column="lastClosePrice">Current Price ($)</th>
            <th data-column="allTimeHighPrice">All Time High ($)</th>
            <th data-column="allTimeHighCount">All-Time High Count*</th>
            <th  class="hidemobile" data-column="lastATH">Last ATH (Days)</th>
            <th data-column="correctionRange">Correction Range (%)</th>
        </tr>
    </thead>
    <tbody>
<?php
    function convertVolume($volume) {
        $billions = $volume / 1_000_000_000;
        $billions_rounded = round($billions, 2);
        $millions = $volume / 1_000_000;
        $millions_rounded = round($millions, 2);
        return [
            'billions' => $billions_rounded,
            'millions' => $millions_rounded
        ];
    }
    
    if ($filterOption=='-10' || $filterOption=='-20' || $filterOption=='-30' || $filterOption=='-40') {
        $categories_query = mysqli_query($con, "SELECT * FROM companies where market_cap>0 and correction_range<$filterOption");
    }
    elseif ($filterOption=='magnificentSeven') {
        $categories_query = mysqli_query($con, "SELECT * FROM companies where market_cap>0 AND symbl='GOOGL' OR symbl='AMZN' OR symbl='AAPL' OR symbl='META' OR symbl='MSFT' OR symbl='NVDA' OR symbl='TSLA'");
    }
    elseif ($filterOption=='custom') {

        $categories_query = mysqli_query($con, "SELECT * FROM companies where market_cap>0 and correction_range<$customnumber");
    }
    elseif ($filterOption=='all') {
      $categories_query = mysqli_query($con, "SELECT * FROM companies where market_cap>0");
    }
    
    while ($fetch_categories = mysqli_fetch_array($categories_query)) {
        $correctionRange = $fetch_categories["correction_range"];
        $market_cap = $fetch_categories["market_cap"];
        $average_volume = $fetch_categories["average_volume"];
        $converted_market_cap = convertVolume($market_cap);
        $converted_average_volume = convertVolume($average_volume);
        $exchange_value = $fetch_categories["exchange_name"];
        if ($exchange_value == 'XNAS') {
            $exchange_name = "NASDAQ";
        } elseif ($exchange_value == 'XNYS') {
            $exchange_name = "NYSE";
        }
?>
        <tr>
                <td class="cname">
                    <a href="https://www.google.com/finance/quote/<?php echo $fetch_categories["symbl"]; ?>:<?php echo $exchange_name; ?>?hl=en&window=1Y" target="_blank">
                        <?php echo htmlspecialchars($fetch_categories["name"]); ?>
                    </a>
                    <span class="heart-icon" data-symbol="<?php echo htmlspecialchars($fetch_categories["symbl"]); ?>">&#9825;</span>
                </td>
                <td class="hidemobile"><?php echo is_numeric($converted_market_cap['billions']) ? number_format($converted_market_cap['billions'], 2) : ''; ?></td>
                <td><?php echo is_numeric($fetch_categories["last_close"]) ? number_format($fetch_categories["last_close"], 2) : ''; ?></td>
                <td><?php echo is_numeric($fetch_categories["all_time_high"]) ? number_format($fetch_categories["all_time_high"], 2) : ''; ?></td>
                <td ><?php echo is_numeric($fetch_categories["all_time_high_count"]) ? number_format($fetch_categories["all_time_high_count"], 0) : ''; ?></td>
                <td class="hidemobile"><?php echo is_numeric($fetch_categories["ath_since"]) ? number_format($fetch_categories["ath_since"], 0) : ''; ?></td>
                
                <td class="<?php if ($correctionRange >= -5) { echo 'bg-danger'; } else if ($correctionRange >= -15) { echo 'bg-warning'; } else { echo 'bg-success'; } ?>">
                    <?php echo is_numeric($fetch_categories["correction_range"]) ? number_format($fetch_categories["correction_range"], 2) : ''; ?>
                </td>
            </tr>
<?php } $con->close(); ?>
    </tbody>
</table>
<?php
if ($filterOption=='magnificentSeven') { ?>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#stockTable').DataTable({
        searching: false,
        paging: false,
        info: false,
        order: [[6, 'asc']], // Sort by column 5 (index 4) in descending order
        columnDefs: [
            { orderSequence: ["desc", "asc"], targets: "_all" } // Set default order sequence for all columns
        ]
    }); 
            }); 
</script>

<?php } else{ ?>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#stockTable').DataTable({
        searching: false,
        paging: false,
        info: false,
        order: [[4, 'desc']], // Sort by column 5 (index 4) in descending order
        columnDefs: [
            { orderSequence: ["desc", "asc"], targets: "_all" } // Set default order sequence for all columns
        ]
    }); 
            }); 
</script>

<?php } ?>

<script>
    $(document).ready(function() {

        $('input[name="filterOption"]').on('change', function() {
            filterTable(this.value);
        });

        $('#companySelect').on('change', function() {
            filterTableByCompany(this.value);
        });

        function filterTable(filterValue) {
            let rows = $('#stockTableBody tr');
            rows.each(function() {
                let correctionRange = parseFloat($(this).find('td:eq(5)').text());
                if (filterValue === 'magnificentSeven') {
                    let magnificentSeven = ['Apple Inc.', 'Alphabet Inc.', 'Microsoft Corporation', 'Amazon.com Inc.', 'Meta Platforms', 'Tesla, Inc.', 'NVIDIA Corporation'];
                    if (magnificentSeven.includes($(this).find('td:eq(0)').text())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                } else {
                    if (correctionRange <= parseFloat(filterValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        }

        function filterTableByCompany(companyName) {
            let rows = $('#stockTableBody tr');
            rows.each(function() {
                if ($(this).find('td:eq(0)').text() === companyName) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Handle heart icon click event
        $('.heart-icon').on('click', function() {
            let symbol = $(this).data('symbol');
            $(this).toggleClass('favorited');
            if ($(this).hasClass('favorited')) {
                $(this).html('&#9829;'); // Change to filled heart
                addFavorite(symbol);
            } else {
                $(this).html('&#9825;'); // Change to outline heart
                removeFavorite(symbol);
            }
        });

        function addFavorite(symbol) {
            // Example using localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            if (!favorites.includes(symbol)) {
                favorites.push(symbol);
                localStorage.setItem('favorites', JSON.stringify(favorites));
            }
        }

        function removeFavorite(symbol) {
            // Example using localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites = favorites.filter(fav => fav !== symbol);
            localStorage.setItem('favorites', JSON.stringify(favorites));
        }

        // Initialize favorite icons on page load
        function initializeFavorites() {
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            $('.heart-icon').each(function() {
                let symbol = $(this).data('symbol');
                if (favorites.includes(symbol)) {
                    $(this).addClass('favorited');
                    $(this).html('&#9829;'); // Set filled heart if favorited
                }
            });
        }

        initializeFavorites();
    });
</script>

<?php } elseif($filterOption=='indexes'){ ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<style>
    .navbar {
    background-image: linear-gradient(to right, #383838, #383838);
    position: fixed;
    width: 100%;
    z-index: 999;
}
    .bg-warning {
        background-color: #f5be19 !important;
    }
    .bg-danger, .bg-success, .bg-warning {
        color: white !important;
        font-weight: 500;
    }
    thead {
        font-size: 13px;
    }
    table {
        text-align: center;
    }
    .cname1 {
        text-align: left !important;
        vertical-align: middle !important;
    }
    .cname {
        text-align: left !important;
    position: relative; /* Establish a positioning context for absolute positioning */
    padding-right: 20px; /* Add padding to the right for the icon */
}

.heart-icon {
    position: absolute; /* Position the heart icon absolutely */
    right: 3px; /* Align it to the right of the cell */
    top: 50%; /* Center vertically */
    transform: translateY(-50%); /* Adjust to perfect vertical centering */
    color: red; /* Optional: Set the color of the heart icon */
}
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #E6E6B1;
    }
    table.dataTable tbody tr {
        background-color: #FFFFC5;
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 9px 2px;
        border-bottom: 1px solid #111;
    }
    table.dataTable thead .sorting {
        background-image: none;
    }    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #FFFFC5;
    }  
    @media (max-width: 768px) {
        .hidemobile {
            display: none;
        }
        thead, table {
            font-size: 10px;
        }
        table.dataTable thead th {
            padding-right: 15px; /* Add padding to the right of header cells */
        }
        table.dataTable thead th.sorting:after, 
        table.dataTable thead th.sorting_asc:after, 
        table.dataTable thead th.sorting_desc:after {
            margin-left: 5px; /* Adjust the margin between text and arrow */
        }
    }
    .table-striped>tbody>tr:nth-of-type(odd)>* {
        --bs-table-accent-bg: rgb(0 0 0 / 0%)!important;
        border-bottom: 1px solid #e7e7e7;
        color: var(--bs-table-striped-color);
        text-align: center;
    }
    table.dataTable tbody th, table.dataTable tbody td {
        border-bottom: 1px solid #e7e7e7;
        color: var(--bs-table-striped-color);
        text-align: center;
    }
    .heart-icon {
        cursor: pointer;
        margin-right: 12px;
        color: #000;
        font-size: 20px;
    }

    .heart-icon.favorited {
        font-size: 20px;
        color: #000;

    }
</style>

<table id="stockTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="cname" data-column="name" width="25%">Company</th>
            <th data-column="lastClosePrice">Last Close Price ($)</th>
            <th data-column="allTimeHighPrice">All Time High ($)</th>
            <th data-column="correctionRange">Correction Range (%)</th>
        </tr>
    </thead>
    <tbody>
<?php
    function convertVolume($volume) {
        $billions = $volume / 1_000_000_000;
        $billions_rounded = round($billions, 2);
        $millions = $volume / 1_000_000;
        $millions_rounded = round($millions, 2);
        return [
            'billions' => $billions_rounded,
            'millions' => $millions_rounded
        ];
    }
    
    
    $categories_query = mysqli_query($con, "SELECT * FROM `indexes`");
    while ($fetch_categories = mysqli_fetch_array($categories_query)) {
     
        $lastClosePrice=$fetch_categories["last_close"];
        $allTimeHighPrice=$fetch_categories["all_time_high"];
        $correctionRange = ($lastClosePrice - $allTimeHighPrice) / $allTimeHighPrice * 100;
        $correctionRange = number_format($correctionRange, 2);

?>
        <tr>
            <td class="cname">
                <a href="<?php echo $fetch_categories["link"]; ?>" target="_blank">
                    <?php echo $fetch_categories["name"]; ?>
                </a>
            </td>
            <td><?php echo $fetch_categories["last_close"]; ?></td>
            <td><?php echo $fetch_categories["all_time_high"]; ?></td>
            <td class="<?php if ($correctionRange >= -5) { echo 'bg-danger'; } else if ($correctionRange >= -15) { echo 'bg-warning'; } else { echo 'bg-success'; } ?>"><?php echo $correctionRange; ?></td>
        </tr>
<?php } $con->close(); ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
          var table = $('#stockTable').DataTable({
        searching: false,
        paging: false,
        info: false,
        order: [], // Disable initial sorting to control via custom logic
        columnDefs: [
            { orderSequence: ["desc", "asc"], targets: "_all" } // Set default order sequence for all columns
        ]
    });



        $('input[name="filterOption"]').on('change', function() {
            filterTable(this.value);
        });

        $('#companySelect').on('change', function() {
            filterTableByCompany(this.value);
        });

        function filterTable(filterValue) {
            let rows = $('#stockTableBody tr');
            rows.each(function() {
                let correctionRange = parseFloat($(this).find('td:eq(5)').text());
                if (filterValue === 'magnificentSeven') {
                    let magnificentSeven = ['Apple Inc.', 'Alphabet Inc.', 'Microsoft Corporation', 'Amazon.com Inc.', 'Meta Platforms', 'Tesla, Inc.', 'NVIDIA Corporation'];
                    if (magnificentSeven.includes($(this).find('td:eq(0)').text())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                } else {
                    if (correctionRange <= parseFloat(filterValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        }

        function filterTableByCompany(companyName) {
            let rows = $('#stockTableBody tr');
            rows.each(function() {
                if ($(this).find('td:eq(0)').text() === companyName) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Handle heart icon click event
        $('.heart-icon').on('click', function() {
            let symbol = $(this).data('symbol');
            $(this).toggleClass('favorited');
            if ($(this).hasClass('favorited')) {
                $(this).html('&#9829;'); // Change to filled heart
                addFavorite(symbol);
            } else {
                $(this).html('&#9825;'); // Change to outline heart
                removeFavorite(symbol);
            }
        });

        function addFavorite(symbol) {
            // Example using localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            if (!favorites.includes(symbol)) {
                favorites.push(symbol);
                localStorage.setItem('favorites', JSON.stringify(favorites));
            }
        }

        function removeFavorite(symbol) {
            // Example using localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites = favorites.filter(fav => fav !== symbol);
            localStorage.setItem('favorites', JSON.stringify(favorites));
        }

        // Initialize favorite icons on page load
        function initializeFavorites() {
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            $('.heart-icon').each(function() {
                let symbol = $(this).data('symbol');
                if (favorites.includes(symbol)) {
                    $(this).addClass('favorited');
                    $(this).html('&#9829;'); // Set filled heart if favorited
                }
            });
        }

        initializeFavorites();
    });
</script>

<?php } elseif ($filterOption=='efts') {?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<style>
    .navbar {
    background-image: linear-gradient(to right, #383838, #383838);
    position: fixed;
    width: 100%;
    z-index: 999;
}
    .bg-warning {
        background-color: #f5be19 !important;
    }
    .bg-danger, .bg-success, .bg-warning {
        color: white !important;
        font-weight: 500;
    }
    thead {
        font-size: 13px;
    }
    table {
        text-align: center;
    }
    .cname1 {
        text-align: left !important;
        vertical-align: middle !important;
    }
    .cname {
        text-align: left !important;
    position: relative; /* Establish a positioning context for absolute positioning */
    padding-right: 20px; /* Add padding to the right for the icon */
}

.heart-icon {
    position: absolute; /* Position the heart icon absolutely */
    right: 3px; /* Align it to the right of the cell */
    top: 50%; /* Center vertically */
    transform: translateY(-50%); /* Adjust to perfect vertical centering */
    color: red; /* Optional: Set the color of the heart icon */
}
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #E6E6B1;
    }
    table.dataTable tbody tr {
        background-color: #FFFFC5;
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 9px 2px;
        border-bottom: 1px solid #111;
    }
    table.dataTable thead .sorting {
        background-image: none;
    }    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #FFFFC5;
    }  
    @media (max-width: 768px) {
        .hidemobile {
            display: none;
        }
        thead, table {
            font-size: 10px;
        }
        table.dataTable thead th {
            padding-right: 15px; /* Add padding to the right of header cells */
        }
        table.dataTable thead th.sorting:after, 
        table.dataTable thead th.sorting_asc:after, 
        table.dataTable thead th.sorting_desc:after {
            margin-left: 5px; /* Adjust the margin between text and arrow */
        }
    }
    .table-striped>tbody>tr:nth-of-type(odd)>* {
        --bs-table-accent-bg: rgb(0 0 0 / 0%)!important;
        border-bottom: 1px solid #e7e7e7;
        color: var(--bs-table-striped-color);
        text-align: center;
    }
    table.dataTable tbody th, table.dataTable tbody td {
        border-bottom: 1px solid #e7e7e7;
        color: var(--bs-table-striped-color);
        text-align: center;
    }
    .heart-icon {
        cursor: pointer;
        margin-right: 12px;
        color: #000;
        font-size: 20px;
    }

    .heart-icon.favorited {
        font-size: 20px;
        color: #000;

    }
    
</style>

<table id="stockTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="cname" data-column="name" width="25%">Company</th>
            <th data-column="lastClosePrice">Last Close Price ($)</th>
            <th data-column="allTimeHighPrice">All Time High ($)</th>
            <th data-column="correctionRange">Correction Range (%)</th>
        </tr>
    </thead>
    <tbody>
<?php
    function convertVolume($volume) {
        $billions = $volume / 1_000_000_000;
        $billions_rounded = round($billions, 2);
        $millions = $volume / 1_000_000;
        $millions_rounded = round($millions, 2);
        return [
            'billions' => $billions_rounded,
            'millions' => $millions_rounded
        ];
    }
    
    
    $categories_query = mysqli_query($con, "SELECT * FROM `efts` ORDER BY ID DESC");
    while ($fetch_categories = mysqli_fetch_array($categories_query)) {
     
        $lastClosePrice=$fetch_categories["last_close"];
        $allTimeHighPrice=$fetch_categories["all_time_high"];
        $correctionRange = ($lastClosePrice - $allTimeHighPrice) / $allTimeHighPrice * 100;
        $correctionRange = number_format($correctionRange, 2);
        $exchange_name=$fetch_categories["exchange_name"];
        $exchange_name = str_replace(' ', '', $exchange_name);
        if ($exchange_name=='XNAS') {
            $exchange_name='NASDAQ';
        }
        elseif ($exchange_name=='ARCX') {
            $exchange_name='NYSEARCA';
        }
        
?>
        <tr>
            <td class="cname">
                <a href="https://www.google.com/finance/quote/<?php echo $fetch_categories["symbl"]; ?>:<?php echo $exchange_name; ?>?window=1Y" target="_blank">
                    <?php echo $fetch_categories["name"]; ?>
                </a>
            </td>
            <td><?php echo $fetch_categories["last_close"]; ?></td>
            <td><?php echo $fetch_categories["all_time_high"]; ?></td>
            <td class="<?php if ($correctionRange >= -5) { echo 'bg-danger'; } else if ($correctionRange >= -15) { echo 'bg-warning'; } else { echo 'bg-success'; } ?>"><?php echo $correctionRange; ?></td>
        </tr>
<?php } $con->close(); ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
          var table = $('#stockTable').DataTable({
        searching: false,
        paging: false,
        info: false,
        order: [], // Disable initial sorting to control via custom logic
        columnDefs: [
            { orderSequence: ["desc", "asc"], targets: "_all" } // Set default order sequence for all columns
        ]
    });



        $('input[name="filterOption"]').on('change', function() {
            filterTable(this.value);
        });

        $('#companySelect').on('change', function() {
            filterTableByCompany(this.value);
        });

        function filterTable(filterValue) {
            let rows = $('#stockTableBody tr');
            rows.each(function() {
                let correctionRange = parseFloat($(this).find('td:eq(5)').text());
                if (filterValue === 'magnificentSeven') {
                    let magnificentSeven = ['Apple Inc.', 'Alphabet Inc.', 'Microsoft Corporation', 'Amazon.com Inc.', 'Meta Platforms', 'Tesla, Inc.', 'NVIDIA Corporation'];
                    if (magnificentSeven.includes($(this).find('td:eq(0)').text())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                } else {
                    if (correctionRange <= parseFloat(filterValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        }

        function filterTableByCompany(companyName) {
            let rows = $('#stockTableBody tr');
            rows.each(function() {
                if ($(this).find('td:eq(0)').text() === companyName) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Handle heart icon click event
        $('.heart-icon').on('click', function() {
            let symbol = $(this).data('symbol');
            $(this).toggleClass('favorited');
            if ($(this).hasClass('favorited')) {
                $(this).html('&#9829;'); // Change to filled heart
                addFavorite(symbol);
            } else {
                $(this).html('&#9825;'); // Change to outline heart
                removeFavorite(symbol);
            }
        });

        function addFavorite(symbol) {
            // Example using localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            if (!favorites.includes(symbol)) {
                favorites.push(symbol);
                localStorage.setItem('favorites', JSON.stringify(favorites));
            }
        }

        function removeFavorite(symbol) {
            // Example using localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites = favorites.filter(fav => fav !== symbol);
            localStorage.setItem('favorites', JSON.stringify(favorites));
        }

        // Initialize favorite icons on page load
        function initializeFavorites() {
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            $('.heart-icon').each(function() {
                let symbol = $(this).data('symbol');
                if (favorites.includes(symbol)) {
                    $(this).addClass('favorited');
                    $(this).html('&#9829;'); // Set filled heart if favorited
                }
            });
        }

        initializeFavorites();
    });
</script>

<?php } elseif ($filterOption=='crypto') {?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<style>
    .navbar {
    background-image: linear-gradient(to right, #383838, #383838);
    position: fixed;
    width: 100%;
    z-index: 999;
}
    .bg-warning {
        background-color: #f5be19 !important;
    }
    .bg-danger, .bg-success, .bg-warning {
        color: white !important;
        font-weight: 500;
    }
    thead {
        font-size: 13px;
    }
    table {
        text-align: center;
    }
    .cname1 {
        text-align: left !important;
        vertical-align: middle !important;
    }
    .cname {
        text-align: left !important;
    position: relative; /* Establish a positioning context for absolute positioning */
    padding-right: 20px; /* Add padding to the right for the icon */
}

.heart-icon {
    position: absolute; /* Position the heart icon absolutely */
    right: 3px; /* Align it to the right of the cell */
    top: 50%; /* Center vertically */
    transform: translateY(-50%); /* Adjust to perfect vertical centering */
    color: red; /* Optional: Set the color of the heart icon */
}
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #E6E6B1;
    }
    table.dataTable tbody tr {
        background-color: #FFFFC5;
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 9px 2px;
        border-bottom: 1px solid #111;
    }
    table.dataTable thead .sorting {
        background-image: none;
    }    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #FFFFC5;
    }  
    @media (max-width: 768px) {
        .hidemobile {
            display: none;
        }
        thead, table {
            font-size: 10px;
        }
        table.dataTable thead th {
            padding-right: 15px; /* Add padding to the right of header cells */
        }
        table.dataTable thead th.sorting:after, 
        table.dataTable thead th.sorting_asc:after, 
        table.dataTable thead th.sorting_desc:after {
            margin-left: 5px; /* Adjust the margin between text and arrow */
        }
    }
    .table-striped>tbody>tr:nth-of-type(odd)>* {
        --bs-table-accent-bg: rgb(0 0 0 / 0%)!important;
        border-bottom: 1px solid #e7e7e7;
        color: var(--bs-table-striped-color);
        text-align: center;
    }
    table.dataTable tbody th, table.dataTable tbody td {
        border-bottom: 1px solid #e7e7e7;
        color: var(--bs-table-striped-color);
        text-align: center;
    }
    .heart-icon {
        cursor: pointer;
        margin-right: 12px;
        color: #000;
        font-size: 20px;
    }

    .heart-icon.favorited {
        font-size: 20px;
        color: #000;

    }
</style>

<table id="stockTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="cname" data-column="name" width="25%">Cryto</th>
            <th data-column="lastClosePrice">Last Close Price ($)</th>
            <th data-column="allTimeHighPrice">All Time High ($)</th>
            <th data-column="correctionRange">Correction Range (%)</th>
        </tr>
    </thead>
    <tbody>
<?php
    function convertVolume($volume) {
        $billions = $volume / 1_000_000_000;
        $billions_rounded = round($billions, 2);
        $millions = $volume / 1_000_000;
        $millions_rounded = round($millions, 2);
        return [
            'billions' => $billions_rounded,
            'millions' => $millions_rounded
        ];
    }
    
    
    $categories_query = mysqli_query($con, "SELECT * FROM `crypto`");
    while ($fetch_categories = mysqli_fetch_array($categories_query)) {
     
        $lastClosePrice=$fetch_categories["last_close_price"];
        $allTimeHighPrice=$fetch_categories["all_time_high"];
        $correctionRange = ($lastClosePrice - $allTimeHighPrice) / $allTimeHighPrice * 100;
        $correctionRange = number_format($correctionRange, 2);

?>
        <tr>
            <td class="cname">
                <a href="https://www.google.com/finance/quote/<?php echo $fetch_categories["symbol"]; ?>-USD?window=1Y" target="_blank">
                    <?php echo $fetch_categories["name"]; ?>
                </a>
            </td>
              <td><?php echo is_numeric($fetch_categories["last_close_price"]) ? number_format($fetch_categories["last_close_price"], 2) : ''; ?></td>
                <td><?php echo is_numeric($fetch_categories["all_time_high"]) ? number_format($fetch_categories["all_time_high"], 2) : ''; ?></td>
            <td class="<?php if ($correctionRange >= -5) { echo 'bg-danger'; } else if ($correctionRange >= -15) { echo 'bg-warning'; } else { echo 'bg-success'; } ?>"><?php echo $correctionRange; ?></td>
        </tr>
<?php } $con->close(); ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
          var table = $('#stockTable').DataTable({
        searching: false,
        paging: false,
        info: false,
        order: [], // Disable initial sorting to control via custom logic
        columnDefs: [
            { orderSequence: ["desc", "asc"], targets: "_all" } // Set default order sequence for all columns
        ]
    });



        $('input[name="filterOption"]').on('change', function() {
            filterTable(this.value);
        });

        $('#companySelect').on('change', function() {
            filterTableByCompany(this.value);
        });

        function filterTable(filterValue) {
            let rows = $('#stockTableBody tr');
            rows.each(function() {
                let correctionRange = parseFloat($(this).find('td:eq(5)').text());
                if (filterValue === 'magnificentSeven') {
                    let magnificentSeven = ['Apple Inc.', 'Alphabet Inc.', 'Microsoft Corporation', 'Amazon.com Inc.', 'Meta Platforms', 'Tesla, Inc.', 'NVIDIA Corporation'];
                    if (magnificentSeven.includes($(this).find('td:eq(0)').text())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                } else {
                    if (correctionRange <= parseFloat(filterValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        }

        function filterTableByCompany(companyName) {
            let rows = $('#stockTableBody tr');
            rows.each(function() {
                if ($(this).find('td:eq(0)').text() === companyName) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Handle heart icon click event
        $('.heart-icon').on('click', function() {
            let symbol = $(this).data('symbol');
            $(this).toggleClass('favorited');
            if ($(this).hasClass('favorited')) {
                $(this).html('&#9829;'); // Change to filled heart
                addFavorite(symbol);
            } else {
                $(this).html('&#9825;'); // Change to outline heart
                removeFavorite(symbol);
            }
        });

        function addFavorite(symbol) {
            // Example using localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            if (!favorites.includes(symbol)) {
                favorites.push(symbol);
                localStorage.setItem('favorites', JSON.stringify(favorites));
            }
        }

        function removeFavorite(symbol) {
            // Example using localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites = favorites.filter(fav => fav !== symbol);
            localStorage.setItem('favorites', JSON.stringify(favorites));
        }

        // Initialize favorite icons on page load
        function initializeFavorites() {
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            $('.heart-icon').each(function() {
                let symbol = $(this).data('symbol');
                if (favorites.includes(symbol)) {
                    $(this).addClass('favorited');
                    $(this).html('&#9829;'); // Set filled heart if favorited
                }
            });
        }

        initializeFavorites();
    });
</script>






<?php } else { ?>




<!---------------------  Favourites Area ----------------------------->


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<style>
    .navbar {
    background-image: linear-gradient(to right, #383838, #383838);
    position: fixed;
    width: 100%;
    z-index: 999;
}
    .bg-warning {
        background-color: #f5be19 !important;
    }
    .bg-danger, .bg-success, .bg-warning {
        color: white !important;
        font-weight: 500;
    }
    thead {
        font-size: 13px;
    }
    table {
        text-align: center;
    }
    .cname1 {
        text-align: left !important;
        vertical-align: middle !important;
    }
    .cname {
        text-align: left !important;
    position: relative; /* Establish a positioning context for absolute positioning */
    padding-right: 20px; /* Add padding to the right for the icon */
}

.heart-icon {
    position: absolute; /* Position the heart icon absolutely */
    right: 3px; /* Align it to the right of the cell */
    top: 50%; /* Center vertically */
    transform: translateY(-50%); /* Adjust to perfect vertical centering */
    color: red; /* Optional: Set the color of the heart icon */
}
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #E6E6B1;
    }
    table.dataTable tbody tr {
        background-color: #FFFFC5;
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 9px 2px;
        border-bottom: 1px solid #111;
    }
    table.dataTable thead .sorting {
        background-image: none;
    }    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #FFFFC5;
    }  
    @media (max-width: 768px) {
        .hidemobile {
            display: none;
        }
        thead, table {
            font-size: 10px;
        }
        table.dataTable thead th {
            padding-right: 15px; /* Add padding to the right of header cells */
        }
        table.dataTable thead th.sorting:after, 
        table.dataTable thead th.sorting_asc:after, 
        table.dataTable thead th.sorting_desc:after {
            margin-left: 5px; /* Adjust the margin between text and arrow */
        }
    }
    .table-striped>tbody>tr:nth-of-type(odd)>* {
        --bs-table-accent-bg: rgb(0 0 0 / 0%)!important;
        border-bottom: 1px solid #e7e7e7;
        color: var(--bs-table-striped-color);
        text-align: center;
    }
    table.dataTable tbody th, table.dataTable tbody td {
        border-bottom: 1px solid #e7e7e7;
        color: var(--bs-table-striped-color);
        text-align: center;
    }
    .heart-icon {
        cursor: pointer;
        margin-right: 12px;
        color: #000;
        font-size: 20px;
    }

    .heart-icon.favorited {
        font-size: 20px;
        color: #000;

    }
</style>





<?php

function convertVolume($volume) {
        $billions = $volume / 1_000_000_000;
        $billions_rounded = round($billions, 2);
        $millions = $volume / 1_000_000;
        $millions_rounded = round($millions, 2);
        return [
            'billions' => $billions_rounded,
            'millions' => $millions_rounded
        ];
    }
// Check if filterOption is set
if (isset($_POST['filterOption'])) {
    $filterOption = $_POST['filterOption'];

    // If the filter option is 'favorite', handle the JSON payload
    if ($filterOption == 'favorite' && isset($_POST['favoriteSymbols'])) {
        $symbols = json_decode($_POST['favoriteSymbols'], true);

        if (!empty($symbols)) {
            // Sanitize symbols for SQL query
            $escapedSymbols = array_map(function($symbol) use ($con) {
                return mysqli_real_escape_string($con, $symbol);
            }, $symbols);
            $symbolsList = "'" . implode("','", $escapedSymbols) . "'";

            // Query to fetch data for favorite companies
            $favorites_query = mysqli_query($con, "SELECT * FROM companies WHERE symbl IN ($symbolsList)");

            if ($favorites_query) {
                echo '<table id="stockTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="cname1" data-column="name" width="25%">Company</th>
                                <th class="hidemobile" data-column="marketCap">Market Cap ($B)</th>
                                <th data-column="lastClosePrice">Current Price ($)</th>
                                <th data-column="allTimeHighPrice">All Time High ($)</th>
                                <th data-column="allTimeHighCount">All-Time High Count*</th>
                                <th  class="hidemobile" data-column="lastATH">Last ATH (Days)</th>
                                <th data-column="correctionRange">Correction Range (%)</th>
                            </tr>
                        </thead>
                        <tbody>';

                while ($row = mysqli_fetch_assoc($favorites_query)) {
                            $market_cap = convertVolume($row["market_cap"]);
                            $average_volume = convertVolume($row["average_volume"]); // Convert average volume using the function
                            $exchange_value = $row["exchange_name"];
                            $exchange_name = ($exchange_value == 'XNAS') ? "NASDAQ" : (($exchange_value == 'XNYS') ? "NYSE" : $exchange_value);
                            $correction_range = $row["correction_range"];
                            $bg_class = '';
                            if ($correction_range >= -5) {
                                $bg_class = 'bg-danger';
                            } elseif ($correction_range >= -15) {
                                $bg_class = 'bg-warning';
                            } else {
                                $bg_class = 'bg-success';
                            }

                            echo '<tr>
                                    <td class="cname">
                                        <a href="https://www.google.com/finance/quote/' . $row["symbl"] . ':' . $exchange_name . '?hl=en&window=1Y" target="_blank">
                                            ' . $row["name"] . '
                                        </a>
                                        <span class="heart-icon favorited" data-symbol="' . $row["symbl"] . '">&#9829;</span>
                                    </td>
                                    <td class="hidemobile">' . (is_numeric($market_cap['billions']) ? number_format($market_cap['billions'], 2) : '') . '</td>
                                    <td>' . (is_numeric($row["last_close"]) ? number_format($row["last_close"], 2) : '') . '</td>
                                    <td>' . (is_numeric($row["all_time_high"]) ? number_format($row["all_time_high"], 2) : '') . '</td>
                                    <td>' . (is_numeric($row["all_time_high_count"]) ? number_format($row["all_time_high_count"]) : '') . '</td>
                                   <td class="hidemobile">' . $row["ath_since"] . '</td>
                                    <td class="' . $bg_class . '">' . $row["correction_range"] . '</td>
                                </tr>';
      
                        }


                echo '</tbody></table>';
            } else {
                echo "<p>No favorite companies found.</p>";
            }
        } else {
            echo "<p>No favorite companies selected.</p>";
        }
    }
    $con->close();
}


?>


<script>
    $(document).ready(function() {
          var table = $('#stockTable').DataTable({
        searching: false,
        paging: false,
        info: false,
        order: [[6, 'asc']], // Sort by column 5 (index 4) in descending order
        columnDefs: [
            { orderSequence: ["desc", "asc"], targets: "_all" } // Set default order sequence for all columns
        ]
    });

        $('input[name="filterOption"]').on('change', function() {
            filterTable(this.value);
        });

        $('#companySelect').on('change', function() {
            filterTableByCompany(this.value);
        });

        function filterTable(filterValue) {
            let rows = $('#stockTableBody tr');
            rows.each(function() {
                let correctionRange = parseFloat($(this).find('td:eq(5)').text());
                if (filterValue === 'magnificentSeven') {
                    let magnificentSeven = ['Apple Inc.', 'Alphabet Inc.', 'Microsoft Corporation', 'Amazon.com Inc.', 'Meta Platforms', 'Tesla, Inc.', 'NVIDIA Corporation'];
                    if (magnificentSeven.includes($(this).find('td:eq(0)').text())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                } else {
                    if (correctionRange <= parseFloat(filterValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        }

        function filterTableByCompany(companyName) {
            let rows = $('#stockTableBody tr');
            rows.each(function() {
                if ($(this).find('td:eq(0)').text() === companyName) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Handle heart icon click event
        $('.heart-icon').on('click', function() {
            let symbol = $(this).data('symbol');
            $(this).toggleClass('favorited');
            if ($(this).hasClass('favorited')) {
                $(this).html('&#9829;'); // Change to filled heart
                addFavorite(symbol);
            } else {
                $(this).html('&#9825;'); // Change to outline heart
                removeFavorite(symbol);
            }
        });

        function addFavorite(symbol) {
            // Example using localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            if (!favorites.includes(symbol)) {
                favorites.push(symbol);
                localStorage.setItem('favorites', JSON.stringify(favorites));
            }
        }

        function removeFavorite(symbol) {
            // Example using localStorage
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites = favorites.filter(fav => fav !== symbol);
            localStorage.setItem('favorites', JSON.stringify(favorites));
        }

        // Initialize favorite icons on page load
        function initializeFavorites() {
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            $('.heart-icon').each(function() {
                let symbol = $(this).data('symbol');
                if (favorites.includes(symbol)) {
                    $(this).addClass('favorited');
                    $(this).html('&#9829;'); // Set filled heart if favorited
                }
            });
        }

        initializeFavorites();
    });
</script>


<?php } ?>
