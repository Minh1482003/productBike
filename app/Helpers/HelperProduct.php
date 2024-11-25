<?php
namespace App\Helpers;

class HelperProduct {
  //FilterState 
  public static function filterStatus($query) {
    $filterState = [
        [
            'name' => 'Tất cả',
            'status' => '',
            'class' => ''
        ],
        [
            'name' => 'Hoạt động',
            'status' => 'active',
            'class' => ''
        ],
        [
            'name' => 'Dừng hoạt động',
            'status' => 'inactive',
            'class' => ''
        ]
    ];

    if ($query->status) {
        $index = array_search($query->status, array_column($filterState, 'status'));
        //array_column tạo ra 1 mảng mới có key status và giá trị của status
        // array_search Tìm trong mảng status giống với query và trả về index
        $filterState[$index]['class'] = 'active';
    } else {
        $filterState[0]['class'] = 'active';
    }
    return $filterState;
  }
  // End FilterState 

  //pagination 
  public static function pagination($req, &$pagination, $totalRecords){
    if ($req->has('page')) {
        $pagination['currentPage'] = (int)$req->query('page');
        $pagination['skipRecords'] = ($pagination['currentPage'] - 1) * $pagination['limitItem'];
    }
    
    $pagination['totalPage'] = ceil($totalRecords / $pagination['limitItem']);
    }
    //End pagination
}