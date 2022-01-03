
@extends('layouts.app')
@section('content')
    
    <br><br>
      <div class="numbar">
        <table align="center" >
          <tr>
            <td>
              <div class="card_1">
                <div class="">
                  Admin
                </div>
                <div class="">
                {{ count($admins) }}
                </div>
              </div>
            </td>
            <td>
              <div class="card_2">
                <div class="">
                  Employee
                </div>
                <div class="">
                {{ count($employees) }}
                </div>
              </div>
            </td>
            <td>
              <div class="card_3">
                <div class="">
                  Delivery Man
                </div>
                <div class="">
                  <?php echo "1"; ?>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="card_4">
                <div class="">
                  Customer
                </div>
                <div class="">
                  <?php echo "1"; ?>
                </div>
              </div>
            </td>
            <td>
              <div class="card_5">
                <div class="">
                  Product
                </div>
                <div class="">
                {{ count($products) }}
                </div>
              </div>
            </td>
            <td>
              <div class="card_6">
                <div class="">
                  Order
                </div>
                <div class="">
                  <?php echo "1"; ?>
                </div>
              </div>
            </td>
          </tr>
        </table>
      </div>


@endsection