<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Correction Territory</title>

    <link rel="icon" href="images/icon.png" type="image/x-icon">
        <!-- All in One SEO 4.6.7.1 - aioseo.com -->
        <meta name="robots" content="max-image-preview:large" />
        <link rel="canonical" href="https://correctionterritory.com/" />
        <meta name="generator" content="All in One SEO (AIOSEO) 4.6.7.1" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:site_name" content="Correction Territory - Invest Simply" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Tracking Stocks' Gap from All-Time Highs" />
        <meta property="og:url" content="https://correctionterritory.com/blogs/home/" />
        <meta property="article:published_time" content="2024-05-20T20:33:00+00:00" />
        <meta property="article:modified_time" content="2024-07-14T21:13:56+00:00" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Tracking Stocks' Gap from All-Time Highs" />

        <meta name="viewport" content="width=device-width, initial-scale=1" />
  
        <link rel="icon" href="images/icon.jpg" type="image/x-icon">
        <link rel="icon" href="images/icon.jpg" type="image/jpg">
        <link rel="apple-touch-icon" href="images/icon.jpg">


        <link rel="canonical" href="https://correctionterritory.com/" class="yoast-seo-meta-tag" />
        <meta property="og:locale" content="en_US" class="yoast-seo-meta-tag" />
        <meta property="og:type" content="article" class="yoast-seo-meta-tag" />
        <meta property="og:title" content="Tracking Stocks' Gap from All-Time Highs" class="yoast-seo-meta-tag" />
        <meta property="og:url" content="https://correctionterritory.com" class="yoast-seo-meta-tag" />
        <meta property="og:site_name" content="Correction Territory" class="yoast-seo-meta-tag" />
        <meta property="article:modified_time" content="2024-07-14T21:13:56+00:00" class="yoast-seo-meta-tag" />
        <meta name="twitter:card" content="summary_large_image" class="yoast-seo-meta-tag" />
</head>
<body>

<?php
 include "db.php";
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
    .form-check-input[type=radio] {
            border-radius: 50%;
            margin-top: 4px !important;
        }
    .bg-warning {
        background-color: #f5be19 !important;
    }
    .mynumber {
    font-size: 13px !important;
    height: 15px !important;
    width: 30px !important;
    border: 1px solid white !important;
    box-shadow: 1px 1px 1px 1px white !important;
    border-bottom: 1px solid black !important;
    margin-top: -1px !important;
    padding: 5px !important;
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
        padding-left: 10px !important;
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
            padding: 5px -5px;
            border-bottom: 1px solid #111;
        }
    table.dataTable thead th{
    padding: 5px 18px !important;
    border-bottom: 1px solid #111;
     }    
    
    table.dataTable thead .sorting {
        background-image:none;
    }    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #FFFFC5;
    }  
      
        
    @media (max-width: 768px) {
        .hidemobile {
            display: none;
        }
        .filterList{
            padding:0px 10px;
        }
        .text1{
            padding:0px 10px !important;
        }
        .heart-icon.favorited {
        font-size: 14px !important;
    }
    .heart-icon {
        cursor: pointer;
        margin-right: 0px !important;
        color: #000;
        font-size: 14px !important;
    }
    table.dataTable thead th {
    padding: 2px 10px !important;
    border-bottom: 1px solid #111;
}
        .customheading{
            padding-left:10px;
            font-size:23px;
        }
            .mynumber {
        font-size: 13px !important;
        height: 13px !important;
        width: 30px !important;
        border: 1px solid white !important;
        box-shadow: 1px 1px 1px 1px white !important;
        border-bottom: 1px solid black !important;
        margin-top: -3px !important;
        padding: 5px !important;
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

.text{
    color: #f1f1f1;
    text-decoration:none;
}
.text:hover{
    color: #ffffff;
    cursor: pointer;
    text-decoration:none;
}
.footer-ul{
    list-style: none;
}
.footer-ul>li{
    padding-top: 12px;
    border-bottom: 1px solid #ffffff3b;
    padding-bottom: 3px;
}
  

.bootstrap-select .dropdown-menu li a span.text {
    color: #0e0e0e !important;
}
.mt-6 {
    margin-top: 6rem !important;
}
.hidedesktop{
    display: none;
}
.filter-option-inner-inner {
    color: black;
    font-weight:500;
}
.dropup .dropdown-toggle::after {
    font-size: 24px !important;
    color: black;
}
.dropdown-toggle::after {
     font-size: 24px !important;
    color: black;
}
</style>
<?php include "header.php" ?>
<div class="container" style="padding:50px 5px;">
   <h3 class="customheading mt-6">S&P 500 Stocks and Their Current Percentage Gap to All-Time High</h3>
   <p style="font-size:16px;" class="text1">*All information on the website refers to the last 5 years</p>
    <div class="row">
        <div class="col-md-6">
                    <p class="text-muted"  style="font-size:18px;" class="text1">Data Last Updated:
                        <?php
                        $sql = "SELECT  `date_time` FROM `companies` where `date_time`!='' ORDER BY `date_time` DESC LIMIT 1";
                        // Execute the query
                        $result = $con->query($sql);

                        // Check if a row was returned
                        if ($result->num_rows > 0) {
                            // Fetch the row as an associative array
                            $row = $result->fetch_assoc();
                             $higest_date_time=$row['date_time'];
                        } else {
                            echo "No results found.";
                        }
                        // Create a DateTime object from the string, assuming the original timezone is USA Eastern Time
                        $date = new DateTime($higest_date_time, new DateTimeZone('America/New_York'));

                        // Set the timezone to Israel
                        $date->setTimezone(new DateTimeZone('Asia/Jerusalem'));

                        // Format the date into the desired format
                        $formatted_date = $date->format('d/m/Y, g:iA');

                        // Output the formatted date
                        echo $formatted_date;
                        ?>
                    </p>

           <div class="mb-3 text1">
                <select id="companySearch" class="selectpicker" data-show-subtext="true" data-live-search="true">
                    <option selected disabled>Search Company</option>
                    <?php
                    $categories_query = mysqli_query($con, "SELECT * FROM companies");
                    while ($fetchc = mysqli_fetch_array($categories_query)) { ?>
                        <option value="<?php echo $fetchc["symbl"]; ?>"><?php echo $fetchc["name"]; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
<script>
$(document).ready(function() {
$('.selectpicker').selectpicker();
 $("#companySearch").on("change",function(){
      var main_id =$('#companySearch').val();

      $.ajax({
      url: "companySearch.php",
      type: "POST",
      data: {
      main_id: main_id
      },
      cache: false,
      success: function(result){
      $("#tablesList").html(result);
      }
      });
    });



});
</script>        
        <div class="col-md-4">
            <table class="table table-bordered">
                <tr>
                    <td><b>Expensive</b></td>
                    <td class="bg-danger" style="text-align:center;">0% to -5%</td>
                </tr>
                <tr>
                    <td><b>Mid-Range</b></td>
                    <td class="bg-warning" style="text-align:center;">-5% to -15%</td>
                </tr>
                <tr>
                    <td><b>Cheap</b></td>
                    <td class="bg-success" style="text-align:center;">-15% or less</td>
                </tr>
            </table>
        </div>
        <div class="container mt-2">
    <div class="row  justify-content-center mb-3 filterList">
        <div class="col-7">
            <div class="row" style="justify-content: end;">
                <div class="col-12 col-md-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filterOptions" id="filterOptions20" value="all">
                        <label class="form-check-label" for="filterOptions20">Show All Stocks</label>
                    </div>
                </div>
                <div class="col-12 col-md-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filterOptions" id="filterOptions1" value="-10">
                        <label class="form-check-label" for="filterOptions1">Down more than 10%</label>
                    </div>
                </div>
            <!--<div class="col-12 col-md-auto">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filterOptions" id="filterOptions8" value="custom">
                    <label class="form-check-label" for="filterOptions8">
                        Down more than
                        <input type="text" id="customnumber" class="mynumber" min="0" value="0"/> %
                    </label>
                </div>
            </div>-->
            <div class="col-12 col-md-auto">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filterOptions" id="filterOptions5" value="magnificentSeven">
                <label class="form-check-label" for="filterOptions5">Magnificent 7</label>
            </div>
        </div>
        <div class="col-12 col-md-auto" style="display:none;">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filterOptions" id="filterOptions7" value="indexes">
                <label class="form-check-label" for="filterOptions7">Indexes</label>
            </div>
        </div>
            </div>
        </div>
        <div class="col-5">
            <div class="row">
                      <div class="col-12 col-md-auto">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filterOptions" id="filterOptions9" value="efts">
                <label class="form-check-label" for="filterOptions9">ETFs</label>
            </div>
        </div>
        <div class="col-12 col-md-auto">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filterOptions" id="filterOptions10" value="crypto">
                <label class="form-check-label" for="filterOptions10">Crypto</label>
            </div>
        </div> 
        <div class="col-12 col-md-auto">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filterOptions" id="filterOptions6" value="favorite">
                <label class="form-check-label" for="filterOptions6">Your Favorites</label>
            </div>
        </div>  
            </div>
        </div>


        
        
        








    </div>
</div>
    </div>
 <div class="table-responsive" id="tablesList">
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
    <tbody id="favoritesTableBody">
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

        $categories_query = mysqli_query($con, "SELECT * FROM companies where market_cap>0");
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
                <td  class="hidemobile"><?php echo is_numeric($converted_market_cap['billions']) ? number_format($converted_market_cap['billions'], 2) : ''; ?></td>
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


    </div>

</div>
<!-- Include JavaScript for handling favorite functionality -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const heartIcons = document.querySelectorAll('.heart-icon');

        heartIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                const symbol = this.getAttribute('data-symbol');
                this.classList.toggle('favorited');
                const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
                
                if (this.classList.contains('favorited')) {
                    this.innerHTML = '&#9829;'; // Filled heart
                    favorites.push(symbol);
                } else {
                    this.innerHTML = '&#9825;'; // Empty heart
                    const index = favorites.indexOf(symbol);
                    if (index > -1) {
                        favorites.splice(index, 1);
                    }
                }
                
                localStorage.setItem('favorites', JSON.stringify(favorites));
            });
        });

        const savedFavorites = JSON.parse(localStorage.getItem('favorites')) || [];
        heartIcons.forEach(icon => {
            if (savedFavorites.includes(icon.getAttribute('data-symbol'))) {
                icon.classList.add('favorited');
                icon.innerHTML = '&#9829;'; // Filled heart
            }
        });
    });
</script>

<!-- Include some CSS for the heart icon -->
<style>
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
            let rows = $('#favoritesTableBody tr');
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
            let rows = $('#favoritesTableBody tr');
            rows.each(function() {
                if ($(this).find('td:eq(0)').text() === companyName) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
</script>

<style type="text/css">
    .footer-wrapper {
    padding: 0px;
    background-color: #333333;
    color: #fff;
}

.footer-widgets {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.footer-widgets .widget {
    flex: 1 1 200px; /* Flex-grow, flex-shrink, flex-basis */
    margin: 10px;
}

.widget-title {
    font-size: 1.2em;
    margin-bottom: 10px;
}

.is-divider {
    margin: 10px 0;
}

.footer .col-inner {
    margin: 0;
    padding: 0;
}

.footer-primary {
    text-align: center;
    margin-top: 20px;
}

@media (max-width: 767px) {
    .footer-widgets {
        flex-direction: column;
        align-items: center;
    }

    .footer-widgets .widget {
        width: 100%;
        max-width: 400px;
    }

    .widget-title {
        text-align: center;
    }
}

@media (max-width: 480px) {
    .footer-widgets .widget {
        padding: 10px;
    }

    .widget-title {
        font-size: 1em;
    }

    .is-divider {
        margin: 5px 0;
    }
}

.absolute-footer {
    text-align: center;
    padding: 7px 0;
    background-color: #111;
}

.back-to-top {
    display: none; /* Initially hidden */
}

@media (min-width: 768px) {
    .back-to-top {
        display: block;
    }
}

</style>

    <script>
    $(document).ready(function() {
        // Trigger the AJAX call when a radio button is selected
        $("input[name='filterOptions']").on("change", function() {
            var selectedValue = $('input[name="filterOptions"]:checked').val(); // Get the selected radio button value
            var customnumber=$('#customnumber').val();
            // Check if the selected value is 'favorite'
            if (selectedValue === 'favorite') {
                // Fetch favorites from localStorage
                var favorites = JSON.parse(localStorage.getItem('favorites')) || [];

                // Send favorites as JSON
                $.ajax({
                    url: "myData.php",
                    type: "POST",
                    data: {
                        filterOption: selectedValue,
                        customnumber:customnumber,
                        favoriteSymbols: JSON.stringify(favorites) // Send favorites array as JSON
                    },
                    cache: false,
                    success: function(result) {
                        $("#tablesList").html(result); // Insert result into the tables list div
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                        $("#tablesList").html("<p>An error occurred while fetching data.</p>");
                    }
                });
            } else {
                // Handle other filter options
                $.ajax({
                    url: "myData.php",
                    type: "POST",
                    data: {
                        filterOption: selectedValue,
                        customnumber:customnumber
                    },
                    cache: false,
                    success: function(result) {
                        $("#tablesList").html(result); // Insert result into the tables list div
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                        $("#tablesList").html("<p>An error occurred while fetching data.</p>");
                    }
                });
            }
        });
    });
</script>

<?php include "footer.php"; ?>
</body>
</html>
