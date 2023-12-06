<?php

function generateBreadcrumbs()
{
    $codeSnippet = 'http://localhost/webfood/src/page';
    $fullPath = $_SERVER['PHP_SELF'];
    // Get the path starting from src/page
    $path = strstr($fullPath, 'src/page');
    $pathParts = explode('/', $path);
    $breadcrumbs = '<p >Home</p> / ';

    for ($i = 1; $i < count($pathParts); $i++) {
        // Use basename to get just the filename
        $filename = basename($pathParts[$i]);
        $breadcrumbs .= '<p >' . $filename . '</p> / ';
    }
    $breadcrumbParts = explode(' / ', $breadcrumbs);

    return $breadcrumbParts;
}

// echo generateBreadcrumbs()
?>


<nav class="flex p-3" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <?php
        foreach (generateBreadcrumbs() as $part) {
            if ($part !== '') {
                echo '
                <li class="inline-flex items-center">
                    <p href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                        ' . $part . '
                    </p>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 "></a>
                    </div>
                </li>';
            }
        }
        ?>

    </ol>
</nav>