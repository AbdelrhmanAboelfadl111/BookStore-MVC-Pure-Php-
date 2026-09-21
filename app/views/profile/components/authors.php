<?php

/**
 * @var string  $totalauthors
 */



?>
<div class="content row" id="authors">
    <?php
    if (!empty($author['data'])) {
        foreach ($author['data'] as $authorItem) {
            $authorImg = asset('imgs/page1.png');
            $shortBio = substr($authorItem['bio'] ?? '', 0, 100);
            if ($shortBio) {
                echo "
                    <div class='col-lg-6 column'>
                        <div class='infoBox h-100 d-flex justify-content-center align-items-center flex-column'>
                            <div class='imgCon'>
                                <img src='{$authorImg}'>
                            </div>
                            <div class='nameCon mb-3'>
                                <h3>{$authorItem['name']}</h3>
                            </div>
                            <div class='infoCon mb-2'>
                                <div class='Bio mb-2'>
                                    <h3 class='lable fw-bold'>BIO :</h3>
                                    <h3 class='info w-80'> {$shortBio} </h3>
                                </div>
                            </div>
                            <div class='btnCon mb-3 w-50'>
                                <button class='btn btn-success m-auto d-block' data-bs-toggle='modal' data-bs-target = '#staticBackdrop7' onclick = 'openAddBook({$authorItem['id']} ,\"{$authorItem['name']}\" )'>Add Book</button>
                            </div>
                        </div>
                    </div>
                ";
            } else {
                echo "
                    <div class='col-lg-6 column'>
                        <div class='infoBox h-100'>
                            <div class='imgCon'>
                                <img src='{$authorImg}'>
                            </div>
                            <div class='nameCon mb-3'>
                                <h3>{$authorItem['name']}</h3>
                            </div>
                            <div class='infoCon mb-2 d-flex justify-content-center align-items-center'>
                                <div class='Bio mb-2'>
                                    <h3 class='lable fw-bold w-100 text-center'> ... </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
        }
    } else {
        echo "<p class= 'alert alert-danger'>No authors</p>";
    }

    ?>




</div>


<?php
if (!empty($author['data'])) {

    $prepareLi = "";

    $pagesNumber = ceil($author['total'] / 10);

    $nextPageNumber = ($author['current_page'] < $pagesNumber) ? $author['current_page'] + 1 : $pagesNumber;

    $isNextPageDisabled = ($author['current_page'] < $pagesNumber) ? '' : 'disabled';

    $isPrevPageDisabled = ($author['current_page'] > 1) ? '' : 'disabled';

    $prevPageNumber = ($author['current_page'] > 1) ? $author['current_page'] - 1 : $author['current_page'];

    $profileLink = route('/profile');

    for ($i = 1; $i <= $pagesNumber; $i++) {
        $isActive = ($author['current_page'] == $i) ? 'active' : '';
        $prepareLi .= "
            <li class='page-item'><a class='page-link {$isActive}' href = '{$profileLink}?Authors-page={$i}'>{$i}</a></li>
        
        
        ";
    }


    echo "
        <nav aria-label='Page navigation example'>
            <ul class='pagination'>
                <li class='page-item'><a class='page-link {$isPrevPageDisabled}' href = '{$profileLink}?Authors-page={$prevPageNumber}'>Previous</a></li>
                {$prepareLi}
                <li class='page-item'><a class='page-link {$isNextPageDisabled}' href = '{$profileLink}?Authors-page={$nextPageNumber}'>Next</a></li>
            </ul>
        </nav>    
    ";
}

?>