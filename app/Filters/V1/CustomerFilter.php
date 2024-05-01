<?php 
namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;
class CustomerFilter extends ApiFilter {
   protected $safeParms = [
    'name' => ['eq'],
    'type' => ['eq'],
    'address' => ['eq'],
    'city' => ['eq'],
    'state' => ['eq'],
    'email' => ['eq'],
    'postalCode' => ['eq', 'lt', 'gt'],
   ];
   protected $columnMap = [
    'postalCode' => 'postal_code'
   ];
    protected $operatorMap = [
    'eq' => '=',
    'lt' => '<',
    'lte' => '<=',
    'gt' => '>',
    'gte' => '>='
   ];

}