<?
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<style>

		/*!
	 * Bootstrap Grid v4.0.0 (https://getbootstrap.com)
	 * Copyright 2011-2018 The Bootstrap Authors
	 * Copyright 2011-2018 Twitter, Inc.
	 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
	 */@-ms-viewport{width:device-width}html{box-sizing:border-box;-ms-overflow-style:scrollbar}*,::after,::before{box-sizing:inherit}.container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.container-fluid{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}.row{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.no-gutters{margin-right:0;margin-left:0}.no-gutters>.col,.no-gutters>[class*=col-]{padding-right:0;padding-left:0}.col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;min-height:1px;padding-right:15px;padding-left:15px}.col{-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-auto{-webkit-box-flex:0;-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:none}.col-1{-webkit-box-flex:0;-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-2{-webkit-box-flex:0;-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-3{-webkit-box-flex:0;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-4{-webkit-box-flex:0;-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-5{-webkit-box-flex:0;-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-6{-webkit-box-flex:0;-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-7{-webkit-box-flex:0;-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-8{-webkit-box-flex:0;-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-9{-webkit-box-flex:0;-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-10{-webkit-box-flex:0;-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-11{-webkit-box-flex:0;-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-12{-webkit-box-flex:0;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}.order-first{-webkit-box-ordinal-group:0;-ms-flex-order:-1;order:-1}.order-last{-webkit-box-ordinal-group:14;-ms-flex-order:13;order:13}.order-0{-webkit-box-ordinal-group:1;-ms-flex-order:0;order:0}.order-1{-webkit-box-ordinal-group:2;-ms-flex-order:1;order:1}.order-2{-webkit-box-ordinal-group:3;-ms-flex-order:2;order:2}.order-3{-webkit-box-ordinal-group:4;-ms-flex-order:3;order:3}.order-4{-webkit-box-ordinal-group:5;-ms-flex-order:4;order:4}.order-5{-webkit-box-ordinal-group:6;-ms-flex-order:5;order:5}.order-6{-webkit-box-ordinal-group:7;-ms-flex-order:6;order:6}.order-7{-webkit-box-ordinal-group:8;-ms-flex-order:7;order:7}.order-8{-webkit-box-ordinal-group:9;-ms-flex-order:8;order:8}.order-9{-webkit-box-ordinal-group:10;-ms-flex-order:9;order:9}.order-10{-webkit-box-ordinal-group:11;-ms-flex-order:10;order:10}.order-11{-webkit-box-ordinal-group:12;-ms-flex-order:11;order:11}.order-12{-webkit-box-ordinal-group:13;-ms-flex-order:12;order:12}.offset-1{margin-left:8.333333%}.offset-2{margin-left:16.666667%}.offset-3{margin-left:25%}.offset-4{margin-left:33.333333%}.offset-5{margin-left:41.666667%}.offset-6{margin-left:50%}.offset-7{margin-left:58.333333%}.offset-8{margin-left:66.666667%}.offset-9{margin-left:75%}.offset-10{margin-left:83.333333%}.offset-11{margin-left:91.666667%}@media (min-width:576px){.col-sm{-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-sm-auto{-webkit-box-flex:0;-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:none}.col-sm-1{-webkit-box-flex:0;-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-sm-2{-webkit-box-flex:0;-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-sm-3{-webkit-box-flex:0;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-sm-4{-webkit-box-flex:0;-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-sm-5{-webkit-box-flex:0;-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-sm-6{-webkit-box-flex:0;-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-sm-7{-webkit-box-flex:0;-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-sm-8{-webkit-box-flex:0;-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-sm-9{-webkit-box-flex:0;-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-sm-10{-webkit-box-flex:0;-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-sm-11{-webkit-box-flex:0;-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-sm-12{-webkit-box-flex:0;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}.order-sm-first{-webkit-box-ordinal-group:0;-ms-flex-order:-1;order:-1}.order-sm-last{-webkit-box-ordinal-group:14;-ms-flex-order:13;order:13}.order-sm-0{-webkit-box-ordinal-group:1;-ms-flex-order:0;order:0}.order-sm-1{-webkit-box-ordinal-group:2;-ms-flex-order:1;order:1}.order-sm-2{-webkit-box-ordinal-group:3;-ms-flex-order:2;order:2}.order-sm-3{-webkit-box-ordinal-group:4;-ms-flex-order:3;order:3}.order-sm-4{-webkit-box-ordinal-group:5;-ms-flex-order:4;order:4}.order-sm-5{-webkit-box-ordinal-group:6;-ms-flex-order:5;order:5}.order-sm-6{-webkit-box-ordinal-group:7;-ms-flex-order:6;order:6}.order-sm-7{-webkit-box-ordinal-group:8;-ms-flex-order:7;order:7}.order-sm-8{-webkit-box-ordinal-group:9;-ms-flex-order:8;order:8}.order-sm-9{-webkit-box-ordinal-group:10;-ms-flex-order:9;order:9}.order-sm-10{-webkit-box-ordinal-group:11;-ms-flex-order:10;order:10}.order-sm-11{-webkit-box-ordinal-group:12;-ms-flex-order:11;order:11}.order-sm-12{-webkit-box-ordinal-group:13;-ms-flex-order:12;order:12}.offset-sm-0{margin-left:0}.offset-sm-1{margin-left:8.333333%}.offset-sm-2{margin-left:16.666667%}.offset-sm-3{margin-left:25%}.offset-sm-4{margin-left:33.333333%}.offset-sm-5{margin-left:41.666667%}.offset-sm-6{margin-left:50%}.offset-sm-7{margin-left:58.333333%}.offset-sm-8{margin-left:66.666667%}.offset-sm-9{margin-left:75%}.offset-sm-10{margin-left:83.333333%}.offset-sm-11{margin-left:91.666667%}}@media (min-width:768px){.col-md{-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-md-auto{-webkit-box-flex:0;-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:none}.col-md-1{-webkit-box-flex:0;-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-md-2{-webkit-box-flex:0;-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-md-3{-webkit-box-flex:0;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-md-4{-webkit-box-flex:0;-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-md-5{-webkit-box-flex:0;-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-webkit-box-flex:0;-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-md-7{-webkit-box-flex:0;-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-webkit-box-flex:0;-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-md-9{-webkit-box-flex:0;-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-webkit-box-flex:0;-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-md-11{-webkit-box-flex:0;-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-md-12{-webkit-box-flex:0;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}.order-md-first{-webkit-box-ordinal-group:0;-ms-flex-order:-1;order:-1}.order-md-last{-webkit-box-ordinal-group:14;-ms-flex-order:13;order:13}.order-md-0{-webkit-box-ordinal-group:1;-ms-flex-order:0;order:0}.order-md-1{-webkit-box-ordinal-group:2;-ms-flex-order:1;order:1}.order-md-2{-webkit-box-ordinal-group:3;-ms-flex-order:2;order:2}.order-md-3{-webkit-box-ordinal-group:4;-ms-flex-order:3;order:3}.order-md-4{-webkit-box-ordinal-group:5;-ms-flex-order:4;order:4}.order-md-5{-webkit-box-ordinal-group:6;-ms-flex-order:5;order:5}.order-md-6{-webkit-box-ordinal-group:7;-ms-flex-order:6;order:6}.order-md-7{-webkit-box-ordinal-group:8;-ms-flex-order:7;order:7}.order-md-8{-webkit-box-ordinal-group:9;-ms-flex-order:8;order:8}.order-md-9{-webkit-box-ordinal-group:10;-ms-flex-order:9;order:9}.order-md-10{-webkit-box-ordinal-group:11;-ms-flex-order:10;order:10}.order-md-11{-webkit-box-ordinal-group:12;-ms-flex-order:11;order:11}.order-md-12{-webkit-box-ordinal-group:13;-ms-flex-order:12;order:12}.offset-md-0{margin-left:0}.offset-md-1{margin-left:8.333333%}.offset-md-2{margin-left:16.666667%}.offset-md-3{margin-left:25%}.offset-md-4{margin-left:33.333333%}.offset-md-5{margin-left:41.666667%}.offset-md-6{margin-left:50%}.offset-md-7{margin-left:58.333333%}.offset-md-8{margin-left:66.666667%}.offset-md-9{margin-left:75%}.offset-md-10{margin-left:83.333333%}.offset-md-11{margin-left:91.666667%}}@media (min-width:992px){.col-lg{-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-lg-auto{-webkit-box-flex:0;-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:none}.col-lg-1{-webkit-box-flex:0;-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-lg-2{-webkit-box-flex:0;-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-lg-3{-webkit-box-flex:0;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-lg-4{-webkit-box-flex:0;-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-lg-5{-webkit-box-flex:0;-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-lg-6{-webkit-box-flex:0;-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-lg-7{-webkit-box-flex:0;-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-lg-8{-webkit-box-flex:0;-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-lg-9{-webkit-box-flex:0;-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-lg-10{-webkit-box-flex:0;-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-lg-11{-webkit-box-flex:0;-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-lg-12{-webkit-box-flex:0;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}.order-lg-first{-webkit-box-ordinal-group:0;-ms-flex-order:-1;order:-1}.order-lg-last{-webkit-box-ordinal-group:14;-ms-flex-order:13;order:13}.order-lg-0{-webkit-box-ordinal-group:1;-ms-flex-order:0;order:0}.order-lg-1{-webkit-box-ordinal-group:2;-ms-flex-order:1;order:1}.order-lg-2{-webkit-box-ordinal-group:3;-ms-flex-order:2;order:2}.order-lg-3{-webkit-box-ordinal-group:4;-ms-flex-order:3;order:3}.order-lg-4{-webkit-box-ordinal-group:5;-ms-flex-order:4;order:4}.order-lg-5{-webkit-box-ordinal-group:6;-ms-flex-order:5;order:5}.order-lg-6{-webkit-box-ordinal-group:7;-ms-flex-order:6;order:6}.order-lg-7{-webkit-box-ordinal-group:8;-ms-flex-order:7;order:7}.order-lg-8{-webkit-box-ordinal-group:9;-ms-flex-order:8;order:8}.order-lg-9{-webkit-box-ordinal-group:10;-ms-flex-order:9;order:9}.order-lg-10{-webkit-box-ordinal-group:11;-ms-flex-order:10;order:10}.order-lg-11{-webkit-box-ordinal-group:12;-ms-flex-order:11;order:11}.order-lg-12{-webkit-box-ordinal-group:13;-ms-flex-order:12;order:12}.offset-lg-0{margin-left:0}.offset-lg-1{margin-left:8.333333%}.offset-lg-2{margin-left:16.666667%}.offset-lg-3{margin-left:25%}.offset-lg-4{margin-left:33.333333%}.offset-lg-5{margin-left:41.666667%}.offset-lg-6{margin-left:50%}.offset-lg-7{margin-left:58.333333%}.offset-lg-8{margin-left:66.666667%}.offset-lg-9{margin-left:75%}.offset-lg-10{margin-left:83.333333%}.offset-lg-11{margin-left:91.666667%}}@media (min-width:1200px){.col-xl{-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}.col-xl-auto{-webkit-box-flex:0;-ms-flex:0 0 auto;flex:0 0 auto;width:auto;max-width:none}.col-xl-1{-webkit-box-flex:0;-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}.col-xl-2{-webkit-box-flex:0;-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}.col-xl-3{-webkit-box-flex:0;-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%}.col-xl-4{-webkit-box-flex:0;-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}.col-xl-5{-webkit-box-flex:0;-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-xl-6{-webkit-box-flex:0;-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}.col-xl-7{-webkit-box-flex:0;-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-xl-8{-webkit-box-flex:0;-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}.col-xl-9{-webkit-box-flex:0;-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-xl-10{-webkit-box-flex:0;-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}.col-xl-11{-webkit-box-flex:0;-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}.col-xl-12{-webkit-box-flex:0;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}.order-xl-first{-webkit-box-ordinal-group:0;-ms-flex-order:-1;order:-1}.order-xl-last{-webkit-box-ordinal-group:14;-ms-flex-order:13;order:13}.order-xl-0{-webkit-box-ordinal-group:1;-ms-flex-order:0;order:0}.order-xl-1{-webkit-box-ordinal-group:2;-ms-flex-order:1;order:1}.order-xl-2{-webkit-box-ordinal-group:3;-ms-flex-order:2;order:2}.order-xl-3{-webkit-box-ordinal-group:4;-ms-flex-order:3;order:3}.order-xl-4{-webkit-box-ordinal-group:5;-ms-flex-order:4;order:4}.order-xl-5{-webkit-box-ordinal-group:6;-ms-flex-order:5;order:5}.order-xl-6{-webkit-box-ordinal-group:7;-ms-flex-order:6;order:6}.order-xl-7{-webkit-box-ordinal-group:8;-ms-flex-order:7;order:7}.order-xl-8{-webkit-box-ordinal-group:9;-ms-flex-order:8;order:8}.order-xl-9{-webkit-box-ordinal-group:10;-ms-flex-order:9;order:9}.order-xl-10{-webkit-box-ordinal-group:11;-ms-flex-order:10;order:10}.order-xl-11{-webkit-box-ordinal-group:12;-ms-flex-order:11;order:11}.order-xl-12{-webkit-box-ordinal-group:13;-ms-flex-order:12;order:12}.offset-xl-0{margin-left:0}.offset-xl-1{margin-left:8.333333%}.offset-xl-2{margin-left:16.666667%}.offset-xl-3{margin-left:25%}.offset-xl-4{margin-left:33.333333%}.offset-xl-5{margin-left:41.666667%}.offset-xl-6{margin-left:50%}.offset-xl-7{margin-left:58.333333%}.offset-xl-8{margin-left:66.666667%}.offset-xl-9{margin-left:75%}.offset-xl-10{margin-left:83.333333%}.offset-xl-11{margin-left:91.666667%}}.d-none{display:none!important}.d-inline{display:inline!important}.d-inline-block{display:inline-block!important}.d-block{display:block!important}.d-table{display:table!important}.d-table-row{display:table-row!important}.d-table-cell{display:table-cell!important}.d-flex{display:-webkit-box!important;display:-ms-flexbox!important;display:flex!important}.d-inline-flex{display:-webkit-inline-box!important;display:-ms-inline-flexbox!important;display:inline-flex!important}@media (min-width:576px){.d-sm-none{display:none!important}.d-sm-inline{display:inline!important}.d-sm-inline-block{display:inline-block!important}.d-sm-block{display:block!important}.d-sm-table{display:table!important}.d-sm-table-row{display:table-row!important}.d-sm-table-cell{display:table-cell!important}.d-sm-flex{display:-webkit-box!important;display:-ms-flexbox!important;display:flex!important}.d-sm-inline-flex{display:-webkit-inline-box!important;display:-ms-inline-flexbox!important;display:inline-flex!important}}@media (min-width:768px){.d-md-none{display:none!important}.d-md-inline{display:inline!important}.d-md-inline-block{display:inline-block!important}.d-md-block{display:block!important}.d-md-table{display:table!important}.d-md-table-row{display:table-row!important}.d-md-table-cell{display:table-cell!important}.d-md-flex{display:-webkit-box!important;display:-ms-flexbox!important;display:flex!important}.d-md-inline-flex{display:-webkit-inline-box!important;display:-ms-inline-flexbox!important;display:inline-flex!important}}@media (min-width:992px){.d-lg-none{display:none!important}.d-lg-inline{display:inline!important}.d-lg-inline-block{display:inline-block!important}.d-lg-block{display:block!important}.d-lg-table{display:table!important}.d-lg-table-row{display:table-row!important}.d-lg-table-cell{display:table-cell!important}.d-lg-flex{display:-webkit-box!important;display:-ms-flexbox!important;display:flex!important}.d-lg-inline-flex{display:-webkit-inline-box!important;display:-ms-inline-flexbox!important;display:inline-flex!important}}@media (min-width:1200px){.d-xl-none{display:none!important}.d-xl-inline{display:inline!important}.d-xl-inline-block{display:inline-block!important}.d-xl-block{display:block!important}.d-xl-table{display:table!important}.d-xl-table-row{display:table-row!important}.d-xl-table-cell{display:table-cell!important}.d-xl-flex{display:-webkit-box!important;display:-ms-flexbox!important;display:flex!important}.d-xl-inline-flex{display:-webkit-inline-box!important;display:-ms-inline-flexbox!important;display:inline-flex!important}}@media print{.d-print-none{display:none!important}.d-print-inline{display:inline!important}.d-print-inline-block{display:inline-block!important}.d-print-block{display:block!important}.d-print-table{display:table!important}.d-print-table-row{display:table-row!important}.d-print-table-cell{display:table-cell!important}.d-print-flex{display:-webkit-box!important;display:-ms-flexbox!important;display:flex!important}.d-print-inline-flex{display:-webkit-inline-box!important;display:-ms-inline-flexbox!important;display:inline-flex!important}}.flex-row{-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;-ms-flex-direction:row!important;flex-direction:row!important}.flex-column{-webkit-box-orient:vertical!important;-webkit-box-direction:normal!important;-ms-flex-direction:column!important;flex-direction:column!important}.flex-row-reverse{-webkit-box-orient:horizontal!important;-webkit-box-direction:reverse!important;-ms-flex-direction:row-reverse!important;flex-direction:row-reverse!important}.flex-column-reverse{-webkit-box-orient:vertical!important;-webkit-box-direction:reverse!important;-ms-flex-direction:column-reverse!important;flex-direction:column-reverse!important}.flex-wrap{-ms-flex-wrap:wrap!important;flex-wrap:wrap!important}.flex-nowrap{-ms-flex-wrap:nowrap!important;flex-wrap:nowrap!important}.flex-wrap-reverse{-ms-flex-wrap:wrap-reverse!important;flex-wrap:wrap-reverse!important}.justify-content-start{-webkit-box-pack:start!important;-ms-flex-pack:start!important;justify-content:flex-start!important}.justify-content-end{-webkit-box-pack:end!important;-ms-flex-pack:end!important;justify-content:flex-end!important}.justify-content-center{-webkit-box-pack:center!important;-ms-flex-pack:center!important;justify-content:center!important}.justify-content-between{-webkit-box-pack:justify!important;-ms-flex-pack:justify!important;justify-content:space-between!important}.justify-content-around{-ms-flex-pack:distribute!important;justify-content:space-around!important}.align-items-start{-webkit-box-align:start!important;-ms-flex-align:start!important;align-items:flex-start!important}.align-items-end{-webkit-box-align:end!important;-ms-flex-align:end!important;align-items:flex-end!important}.align-items-center{-webkit-box-align:center!important;-ms-flex-align:center!important;align-items:center!important}.align-items-baseline{-webkit-box-align:baseline!important;-ms-flex-align:baseline!important;align-items:baseline!important}.align-items-stretch{-webkit-box-align:stretch!important;-ms-flex-align:stretch!important;align-items:stretch!important}.align-content-start{-ms-flex-line-pack:start!important;align-content:flex-start!important}.align-content-end{-ms-flex-line-pack:end!important;align-content:flex-end!important}.align-content-center{-ms-flex-line-pack:center!important;align-content:center!important}.align-content-between{-ms-flex-line-pack:justify!important;align-content:space-between!important}.align-content-around{-ms-flex-line-pack:distribute!important;align-content:space-around!important}.align-content-stretch{-ms-flex-line-pack:stretch!important;align-content:stretch!important}.align-self-auto{-ms-flex-item-align:auto!important;align-self:auto!important}.align-self-start{-ms-flex-item-align:start!important;align-self:flex-start!important}.align-self-end{-ms-flex-item-align:end!important;align-self:flex-end!important}.align-self-center{-ms-flex-item-align:center!important;align-self:center!important}.align-self-baseline{-ms-flex-item-align:baseline!important;align-self:baseline!important}.align-self-stretch{-ms-flex-item-align:stretch!important;align-self:stretch!important}@media (min-width:576px){.flex-sm-row{-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;-ms-flex-direction:row!important;flex-direction:row!important}.flex-sm-column{-webkit-box-orient:vertical!important;-webkit-box-direction:normal!important;-ms-flex-direction:column!important;flex-direction:column!important}.flex-sm-row-reverse{-webkit-box-orient:horizontal!important;-webkit-box-direction:reverse!important;-ms-flex-direction:row-reverse!important;flex-direction:row-reverse!important}.flex-sm-column-reverse{-webkit-box-orient:vertical!important;-webkit-box-direction:reverse!important;-ms-flex-direction:column-reverse!important;flex-direction:column-reverse!important}.flex-sm-wrap{-ms-flex-wrap:wrap!important;flex-wrap:wrap!important}.flex-sm-nowrap{-ms-flex-wrap:nowrap!important;flex-wrap:nowrap!important}.flex-sm-wrap-reverse{-ms-flex-wrap:wrap-reverse!important;flex-wrap:wrap-reverse!important}.justify-content-sm-start{-webkit-box-pack:start!important;-ms-flex-pack:start!important;justify-content:flex-start!important}.justify-content-sm-end{-webkit-box-pack:end!important;-ms-flex-pack:end!important;justify-content:flex-end!important}.justify-content-sm-center{-webkit-box-pack:center!important;-ms-flex-pack:center!important;justify-content:center!important}.justify-content-sm-between{-webkit-box-pack:justify!important;-ms-flex-pack:justify!important;justify-content:space-between!important}.justify-content-sm-around{-ms-flex-pack:distribute!important;justify-content:space-around!important}.align-items-sm-start{-webkit-box-align:start!important;-ms-flex-align:start!important;align-items:flex-start!important}.align-items-sm-end{-webkit-box-align:end!important;-ms-flex-align:end!important;align-items:flex-end!important}.align-items-sm-center{-webkit-box-align:center!important;-ms-flex-align:center!important;align-items:center!important}.align-items-sm-baseline{-webkit-box-align:baseline!important;-ms-flex-align:baseline!important;align-items:baseline!important}.align-items-sm-stretch{-webkit-box-align:stretch!important;-ms-flex-align:stretch!important;align-items:stretch!important}.align-content-sm-start{-ms-flex-line-pack:start!important;align-content:flex-start!important}.align-content-sm-end{-ms-flex-line-pack:end!important;align-content:flex-end!important}.align-content-sm-center{-ms-flex-line-pack:center!important;align-content:center!important}.align-content-sm-between{-ms-flex-line-pack:justify!important;align-content:space-between!important}.align-content-sm-around{-ms-flex-line-pack:distribute!important;align-content:space-around!important}.align-content-sm-stretch{-ms-flex-line-pack:stretch!important;align-content:stretch!important}.align-self-sm-auto{-ms-flex-item-align:auto!important;align-self:auto!important}.align-self-sm-start{-ms-flex-item-align:start!important;align-self:flex-start!important}.align-self-sm-end{-ms-flex-item-align:end!important;align-self:flex-end!important}.align-self-sm-center{-ms-flex-item-align:center!important;align-self:center!important}.align-self-sm-baseline{-ms-flex-item-align:baseline!important;align-self:baseline!important}.align-self-sm-stretch{-ms-flex-item-align:stretch!important;align-self:stretch!important}}@media (min-width:768px){.flex-md-row{-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;-ms-flex-direction:row!important;flex-direction:row!important}.flex-md-column{-webkit-box-orient:vertical!important;-webkit-box-direction:normal!important;-ms-flex-direction:column!important;flex-direction:column!important}.flex-md-row-reverse{-webkit-box-orient:horizontal!important;-webkit-box-direction:reverse!important;-ms-flex-direction:row-reverse!important;flex-direction:row-reverse!important}.flex-md-column-reverse{-webkit-box-orient:vertical!important;-webkit-box-direction:reverse!important;-ms-flex-direction:column-reverse!important;flex-direction:column-reverse!important}.flex-md-wrap{-ms-flex-wrap:wrap!important;flex-wrap:wrap!important}.flex-md-nowrap{-ms-flex-wrap:nowrap!important;flex-wrap:nowrap!important}.flex-md-wrap-reverse{-ms-flex-wrap:wrap-reverse!important;flex-wrap:wrap-reverse!important}.justify-content-md-start{-webkit-box-pack:start!important;-ms-flex-pack:start!important;justify-content:flex-start!important}.justify-content-md-end{-webkit-box-pack:end!important;-ms-flex-pack:end!important;justify-content:flex-end!important}.justify-content-md-center{-webkit-box-pack:center!important;-ms-flex-pack:center!important;justify-content:center!important}.justify-content-md-between{-webkit-box-pack:justify!important;-ms-flex-pack:justify!important;justify-content:space-between!important}.justify-content-md-around{-ms-flex-pack:distribute!important;justify-content:space-around!important}.align-items-md-start{-webkit-box-align:start!important;-ms-flex-align:start!important;align-items:flex-start!important}.align-items-md-end{-webkit-box-align:end!important;-ms-flex-align:end!important;align-items:flex-end!important}.align-items-md-center{-webkit-box-align:center!important;-ms-flex-align:center!important;align-items:center!important}.align-items-md-baseline{-webkit-box-align:baseline!important;-ms-flex-align:baseline!important;align-items:baseline!important}.align-items-md-stretch{-webkit-box-align:stretch!important;-ms-flex-align:stretch!important;align-items:stretch!important}.align-content-md-start{-ms-flex-line-pack:start!important;align-content:flex-start!important}.align-content-md-end{-ms-flex-line-pack:end!important;align-content:flex-end!important}.align-content-md-center{-ms-flex-line-pack:center!important;align-content:center!important}.align-content-md-between{-ms-flex-line-pack:justify!important;align-content:space-between!important}.align-content-md-around{-ms-flex-line-pack:distribute!important;align-content:space-around!important}.align-content-md-stretch{-ms-flex-line-pack:stretch!important;align-content:stretch!important}.align-self-md-auto{-ms-flex-item-align:auto!important;align-self:auto!important}.align-self-md-start{-ms-flex-item-align:start!important;align-self:flex-start!important}.align-self-md-end{-ms-flex-item-align:end!important;align-self:flex-end!important}.align-self-md-center{-ms-flex-item-align:center!important;align-self:center!important}.align-self-md-baseline{-ms-flex-item-align:baseline!important;align-self:baseline!important}.align-self-md-stretch{-ms-flex-item-align:stretch!important;align-self:stretch!important}}@media (min-width:992px){.flex-lg-row{-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;-ms-flex-direction:row!important;flex-direction:row!important}.flex-lg-column{-webkit-box-orient:vertical!important;-webkit-box-direction:normal!important;-ms-flex-direction:column!important;flex-direction:column!important}.flex-lg-row-reverse{-webkit-box-orient:horizontal!important;-webkit-box-direction:reverse!important;-ms-flex-direction:row-reverse!important;flex-direction:row-reverse!important}.flex-lg-column-reverse{-webkit-box-orient:vertical!important;-webkit-box-direction:reverse!important;-ms-flex-direction:column-reverse!important;flex-direction:column-reverse!important}.flex-lg-wrap{-ms-flex-wrap:wrap!important;flex-wrap:wrap!important}.flex-lg-nowrap{-ms-flex-wrap:nowrap!important;flex-wrap:nowrap!important}.flex-lg-wrap-reverse{-ms-flex-wrap:wrap-reverse!important;flex-wrap:wrap-reverse!important}.justify-content-lg-start{-webkit-box-pack:start!important;-ms-flex-pack:start!important;justify-content:flex-start!important}.justify-content-lg-end{-webkit-box-pack:end!important;-ms-flex-pack:end!important;justify-content:flex-end!important}.justify-content-lg-center{-webkit-box-pack:center!important;-ms-flex-pack:center!important;justify-content:center!important}.justify-content-lg-between{-webkit-box-pack:justify!important;-ms-flex-pack:justify!important;justify-content:space-between!important}.justify-content-lg-around{-ms-flex-pack:distribute!important;justify-content:space-around!important}.align-items-lg-start{-webkit-box-align:start!important;-ms-flex-align:start!important;align-items:flex-start!important}.align-items-lg-end{-webkit-box-align:end!important;-ms-flex-align:end!important;align-items:flex-end!important}.align-items-lg-center{-webkit-box-align:center!important;-ms-flex-align:center!important;align-items:center!important}.align-items-lg-baseline{-webkit-box-align:baseline!important;-ms-flex-align:baseline!important;align-items:baseline!important}.align-items-lg-stretch{-webkit-box-align:stretch!important;-ms-flex-align:stretch!important;align-items:stretch!important}.align-content-lg-start{-ms-flex-line-pack:start!important;align-content:flex-start!important}.align-content-lg-end{-ms-flex-line-pack:end!important;align-content:flex-end!important}.align-content-lg-center{-ms-flex-line-pack:center!important;align-content:center!important}.align-content-lg-between{-ms-flex-line-pack:justify!important;align-content:space-between!important}.align-content-lg-around{-ms-flex-line-pack:distribute!important;align-content:space-around!important}.align-content-lg-stretch{-ms-flex-line-pack:stretch!important;align-content:stretch!important}.align-self-lg-auto{-ms-flex-item-align:auto!important;align-self:auto!important}.align-self-lg-start{-ms-flex-item-align:start!important;align-self:flex-start!important}.align-self-lg-end{-ms-flex-item-align:end!important;align-self:flex-end!important}.align-self-lg-center{-ms-flex-item-align:center!important;align-self:center!important}.align-self-lg-baseline{-ms-flex-item-align:baseline!important;align-self:baseline!important}.align-self-lg-stretch{-ms-flex-item-align:stretch!important;align-self:stretch!important}}@media (min-width:1200px){.flex-xl-row{-webkit-box-orient:horizontal!important;-webkit-box-direction:normal!important;-ms-flex-direction:row!important;flex-direction:row!important}.flex-xl-column{-webkit-box-orient:vertical!important;-webkit-box-direction:normal!important;-ms-flex-direction:column!important;flex-direction:column!important}.flex-xl-row-reverse{-webkit-box-orient:horizontal!important;-webkit-box-direction:reverse!important;-ms-flex-direction:row-reverse!important;flex-direction:row-reverse!important}.flex-xl-column-reverse{-webkit-box-orient:vertical!important;-webkit-box-direction:reverse!important;-ms-flex-direction:column-reverse!important;flex-direction:column-reverse!important}.flex-xl-wrap{-ms-flex-wrap:wrap!important;flex-wrap:wrap!important}.flex-xl-nowrap{-ms-flex-wrap:nowrap!important;flex-wrap:nowrap!important}.flex-xl-wrap-reverse{-ms-flex-wrap:wrap-reverse!important;flex-wrap:wrap-reverse!important}.justify-content-xl-start{-webkit-box-pack:start!important;-ms-flex-pack:start!important;justify-content:flex-start!important}.justify-content-xl-end{-webkit-box-pack:end!important;-ms-flex-pack:end!important;justify-content:flex-end!important}.justify-content-xl-center{-webkit-box-pack:center!important;-ms-flex-pack:center!important;justify-content:center!important}.justify-content-xl-between{-webkit-box-pack:justify!important;-ms-flex-pack:justify!important;justify-content:space-between!important}.justify-content-xl-around{-ms-flex-pack:distribute!important;justify-content:space-around!important}.align-items-xl-start{-webkit-box-align:start!important;-ms-flex-align:start!important;align-items:flex-start!important}.align-items-xl-end{-webkit-box-align:end!important;-ms-flex-align:end!important;align-items:flex-end!important}.align-items-xl-center{-webkit-box-align:center!important;-ms-flex-align:center!important;align-items:center!important}.align-items-xl-baseline{-webkit-box-align:baseline!important;-ms-flex-align:baseline!important;align-items:baseline!important}.align-items-xl-stretch{-webkit-box-align:stretch!important;-ms-flex-align:stretch!important;align-items:stretch!important}.align-content-xl-start{-ms-flex-line-pack:start!important;align-content:flex-start!important}.align-content-xl-end{-ms-flex-line-pack:end!important;align-content:flex-end!important}.align-content-xl-center{-ms-flex-line-pack:center!important;align-content:center!important}.align-content-xl-between{-ms-flex-line-pack:justify!important;align-content:space-between!important}.align-content-xl-around{-ms-flex-line-pack:distribute!important;align-content:space-around!important}.align-content-xl-stretch{-ms-flex-line-pack:stretch!important;align-content:stretch!important}.align-self-xl-auto{-ms-flex-item-align:auto!important;align-self:auto!important}.align-self-xl-start{-ms-flex-item-align:start!important;align-self:flex-start!important}.align-self-xl-end{-ms-flex-item-align:end!important;align-self:flex-end!important}.align-self-xl-center{-ms-flex-item-align:center!important;align-self:center!important}.align-self-xl-baseline{-ms-flex-item-align:baseline!important;align-self:baseline!important}.align-self-xl-stretch{-ms-flex-item-align:stretch!important;align-self:stretch!important}}
	/*# sourceMappingURL=bootstrap-grid.min.css.map */


	*{
		margin: 0;
		padding: 0;
	}
	h1{
		color: #ffffff;
	    text-transform: uppercase;
	    font-weight: 900;
	    font-size: 18px;
	    margin-bottom: 20px;
	}
	a:hover{
		text-decoration: none;
	}
	.container{
		max-width: 1400px !important;
	}
	body{
	    background-color: #3c3c3c;
	    font-size: 14px;
	    font-family: Arial;
	}
	.search{
		padding-top: 30px;
	}
	.form-search input,
	select{
		width: 100%;
	    height: 40px;
	    border-radius: 0;
	    padding: 0 15px;
	    box-sizing: border-box;
	    margin-bottom: 20px;
	    border: none;
	    outline: none;
	    background: #7b7b7b;
    	color: #fff;
    	font-size: 14px; 
    	font-family: Arial;
	}
	.form-search input::-webkit-input-placeholder {color: #fff; font-size: 14px; font-family: Arial;}
	.form-search input::-moz-placeholder          {color: #fff; font-size: 14px; font-family: Arial;}/* Firefox 19+ */
	.form-search input:-moz-placeholder           {color: #fff; font-size: 14px; font-family: Arial;}/* Firefox 18- */
	.form-search input:-ms-input-placeholder      {color: #fff; font-size: 14px; font-family: Arial;}

	.form-search input[type="submit"]{
		background: #d86f6f;
    	color: #fff;
    	cursor: pointer;
    	margin-bottom: 0;
    	transition: .2s;
    	font-weight: 700;
   		font-size: 16px;
	}
	.form-search input[type="submit"]:hover{
		background: #a23c3c;
	}
	.content-search{
		background: #4e4e4e;
    	padding: 15px;
        min-height: 100%;
	}
	.title-project{
		display: flex;
    	align-items: center;
	}
	.title-project img{
		width: 30px;
	    height: 30px;
	    object-fit: contain;
	}
	.content-search__site{
		margin-right: 15px;
	}
	.result-item {
	    color: #ffffff;
	    background: #484848;
	    margin-bottom: 10px;
	    padding: 10px 15px;
	    font-size: 16px;
	    display: flex;
	    align-items: center;
	    justify-content: space-between;
	    cursor: pointer;
	    transition: background 0.2s;
	}
	.result-item:hover{
		background: #424242;
	}
	.trig-res{
		background: #3a3a3a !important;
	}
	.content-info__append{
	    font-size: 16px;
	    color: #eaeaea;
	    line-height: 22px;
	}
	.content-search__static{
		margin-right: 7px;
	}
	.result-item__cory{
		cursor: pointer;
		border: none;
   	background: none;
	}
	.result-item__cory:before{
		content: "";
		background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAMAAACdt4HsAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABBVBMVEUAAADXa2vXb2/Yb2/Yb2/Yb2/Yb2/Xb2/Vb2/acHDYb2/Yb2/Xbm7XbW3Yb2/Xb2/VamrYb2/Wa2vZcHDXbm7Zb2/Xb2/Yb2/Yb2/Yb2/Yb2/jcXHZcXHZb2/Yb2/MZmbYcHDYb2/Yb2/VamrYcHDacXHZb2/YcHDZcHDYb2/Zb2/Yb2/ZbW3Yb2/Yb2/Yb2/Zb2/Yb2/YbGzYb2/Zb2/RdHS/gIDYb2/Yb2/Yb2/ab2/Yb2/XcXHYb2/Ybm7YcHDZb2/Yb2/Yb2/Yb2/Yb2/Yb2/SaWnYbm7Yb2/Zbm7YcHDYb2/Yb2/XcHDZcXHYb2/Ybm7cdHTZb2/Xbm7/VVXYb28AAABnMSm2AAAAVXRSTlMAE4HN9PbWjh5L7/dmRvtnDOcfa42z1bXd7vUJPYzmCnsu3xjgImqJmZV+Ti+q/uplfCHikwsE0WPpPrxN7X2Q25Ha8czsEUjkQ7CI1yAbpWEWul8DK7ZeAwAAAAFiS0dEAIgFHUgAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAAHdElNRQfkBx4TIzolIrxyAAABMElEQVRYw+3X2VLCMBQG4KMtghYBK6CACAJuqIiIAu6K+77l/V9FUsk06VVOznCX//7/pmnOZOYASJmadlymm9hMPAFqZue02//xkkp/PoXsj5KW+pkFfJ95fggsGvQZy4ZAzgjIh8DSskYKUaAIyJRWyquKgAVGqVRdGgCwViMCUG+owPrG5pZWtps7paCx60pAfa+FuLf9diAchEDnEHn1XQ4cibmF4x56eIJvyAqgj5++Af8PJwI4xQPsjE+UAM4NgAt+hvHjAZgbELnkwNUYMOizaw7cWMACFrCABSxggUkAQypwSwWaRODungakHoAEPD4BAcg9pytAAUTIQMwAeJGBVwNA3hYhju+33mTgHX+GD3V9+cT2G1+RBajtofqOD9Ekynndcwy+f37V8h/SwGZJgY585gAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyMC0wNy0zMFQxOTozNTo1OCswMDowMAtmsOUAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMjAtMDctMzBUMTk6MzU6NTgrMDA6MDB6OwhZAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAABJRU5ErkJggg==);

		display: block;
		width: 15px;
		height: 15px;
		background-size: 100%
	}
	.child {
	    background: #4e4e4e;
	    padding: 30px;
	    margin-top: 15px;
	}
	.sidebar-item:first-child .child{
		margin-top: 0;
	}
	.ajax-pre img{
		width: 40px;
	}
	.color-red{
		color: #d86f6f;
	}
	@keyframes copyAdd{
		0%{
			transform: translateX(100px);
			opacity: 0;
		}
		100%{
			transform: translateX(0px);
			opacity: 1;
		}
	}
	@keyframes copyRemove{
		0%{
			transform: translateX(0px);
			opacity: 1;
		}
		100%{
			transform: translateX(100px);
			opacity: 0;
		}
	}
	.copy-remove{
		animation: 0.5s copyRemove ease-in-out;
	}
	.copy-add{
		animation: 0.5s copyAdd ease-in-out;
	}
	.copy-accept {
	    position: fixed;
	    top: 15px;
	    right: 0;
	    background: #d86f6f;
	    color: #fff;
	    padding: 20px;
	}
	.history__item{
		color: #eaeaea;
	    text-decoration: none;
	    padding: 7px 0;
	    display: flex;
	    justify-content: space-between;
	    cursor: pointer;
	    border-bottom: 1px solid #636363;
	    font-size: 16px;
	}
	.history__item-name{
		transition: color 0.2s;
	}
	.history__item:hover .history__item-name{
		color: #ffabab;
	}
	.history__item:last-child{
		border-bottom: none;
	}
	.history__title{
		color: #ffffff;
	    margin-bottom: 10px;
	    font-size: 16px;
	    transition: color 0.2s;
	}
	.sidebar-wrap{
		position: relative;
	}
	.version{
		color: #d86f6f;
	    text-align: center;
	    position: absolute;
	    left: 0;
	    right: 0;
	    bottom: -35px;
	}
	.title-project-img{
		width: 50px;
	    height: 36px;
	    display: block;
		background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADMAAAAkCAMAAAATrPI7AAAA7VBMVEUAAADPcHDfcHD////ea2v////XcHD////UcHDacHD////jkpL////XcHDrt7f////WcHD////Zbm7////XcHD////abm7////WcHD////Zbm777e3////XcHD////Yb2/ab2/////YcHDYb2/01NT////////Yb2/Zb2/////Yb2/////Yb2/Zb2/////Yb2/////Xb2/Zb2/////Yb2/aeHjbeHjcgYHdgYHfiorgiorhk5Pik5PknJzmpaXnpaXprq7rt7fst7ftwMDuwMDwycny0tLz0tL129v35OT45OT67e389vb99vb///8kYRRRAAAANHRSTlMAEBAQHx8gIDAwMD8/QEBAUFBfX2Bgb29wcH9/f4CAj4+PkJ+fn6Cvr6+/v8/Pz9/f7+/v5wkxbAAAAf5JREFUeNqVlYW66joQRme7u7sLbn/2nQoS7BZC+/6PcwhzpHxF1ydIu0aiFGfl8i1bBsrZr8ttWoiDNGIUTpc1FrJeMYG3zRnGShYTKUyXVgrAspJkmSytTFYeMIP0RGUTgt/oaB8Jric50gxrT8EzzYRTmlDduShtyRX9l5Buk47MZYcxYoJTImE3tTbejYHk6SLJAY3IHF2NlYZIum8zkjzRiOLGPQnPGBEYnjfcxaOrsXbghoMGkij+11Dxfn9spAE2kanJt1ZLAX6nxi20A6fRwAodfZxQJrV79LIVd4D60GI76iqsov6/crt9uCbwNNYfr7YqlCqe7N+n4o5YA0bgcI9hHKDbBTR8jcMi7d7TR/GMLvJxh7UCOOz8RKrL8AcAOi3rBB7uUjTkpbJF9xlaI8qJ4vd4NNaBHzUU0LZOV6POHKFU/LBOMUOUeqH7f2Mto6Y7bGeKe5GCMhoajQD1lK3o5mPoZO63zv7OaVecPsP02O/8hG1uBq0GQ/f5/Sh63Lq5un8hyl/ZMlfFcXs1O74u4JqwpVA3xvVD+18U7NF9pXJFqWGGz+JWbFJR1Q0PkyiQcBE7pDCHxJEVS7TMMXKwfBo73DP4psmkl6pMWC0sp4iUW04Rbif2skIz2SkkkhzTXM7HhiJ9uUKLsHn+nbN3Y+H7coem8wu8JeOjEekAZwAAAABJRU5ErkJggg==);
	    background-size: auto;
    	background-repeat: no-repeat;
	}
	.content-search_err{
		color: #d86f6f;
	}
	.result-item__format{
		margin-right: 15px;
	    padding: 4px 6px;
	    min-width: 39px;
	    border-radius: 30px;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	    font-size: 11px;
	}
	.result-item__feat{
	    display: flex;
	}
	</style>
	<meta charset="UTF-8">
	<title>Поиск на <?php echo $_SERVER['HTTP_HOST']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?
	set_time_limit(0);
	?>
	<div class="search">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-4 sidebar">
					<div class="sidebar-wrap">
						<div class="form-search sidebar-item">
							<form method="post" class="form child"> 
								<input class="string-search" placeholder="Строка в файле" name="string" type="text">
								<select class="file-search" size="1" name="format">
								    <option selected disabled>Расширение</option>
								    <option value="php">php</option>
								    <option value="html">html</option>
								    <option value="css">css</option>
								    <option value="js">js</option>
									<option value="all">Искать все расширения</option>
								</select>
								<input class="format-search"  placeholder="Формат файлов" name="fotmat_" type="text">  
								<input name="Submit" type="submit" value="Поиск"> 
							</form>
						</div>
						<div class="content-info__append sidebar-item"></div>
						<div class="history sidebar-item"></div>
						<p class="version">version 2.1</p>
					</div>
				</div>
				<div class="col-xl-9 col-lg-8">
					<div class="content-search">
						<h1 class="title-project">
							<span class="content-search__static">Поиск по сайту</span>
							<a target="_blank" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>" class="content-search__site color-red"> <?php echo $_SERVER['HTTP_HOST']; ?></a>
							<?php
							$file = 'http://' . $_SERVER['HTTP_HOST'] . "/favicon.ico";
							if ($file):
								echo '<img src="' .  $file  . '" alt="">';
							else:
								echo '<div class="title-project-img"></div>';
							endif
							?>
						</h1>
						<div class="content-search__append"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script
		src="https://code.jquery.com/jquery-3.5.1.min.js"
		integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
		crossorigin="anonymous">
  	</script>
	<script>
		$('.form-search input[type="submit"]').click(function(e) {
			e.preventDefault();
			ajaxForm();
		});

		function copytext(el) {
		    var $tmp = $("<textarea>");
		    var txtUri = $(el).text();

		    $("body").append($tmp);
		    $tmp.val(txtUri).select();
		    document.execCommand("copy");
		    $tmp.remove();
		    $('body').append('<div class="copy-add copy-accept">Путь до файла скопирован</div>')
	    	setTimeout(function(){
				$('.copy-accept').removeClass('copy-add');
				$('.copy-accept').addClass('copy-remove');
				setTimeout(function(){
					$('.copy-accept').remove();
				}, 400)
			}, 3000);
		}
		function ajaxForm(){
			var stringSearch = $('.string-search').val();
			var fileSearch = $('.file-search').val();
			var formatSearch = $('.format-search').val();

			$.ajax({
				method: "POST",
				url: 'savetool.php',
				data: {'stringSearch': stringSearch, 'fileSearch': fileSearch, 'formatSearch': formatSearch,},
				success: function(data){
					var htmlSearch = $(data).find('.search-result').html();
					var htmlInfo = $(data).find('.info-search').html();
					var numFile = $(data).find('.num-file').html();
					$('.content-search__append').html(htmlSearch);
					$('.content-info__append').html(htmlInfo);
					$('.result-item').click(function(event) {
						$('.result-item').removeClass('trig-res');
						$(this).addClass('trig-res');
					});
					var historyExist = $('.history__item').text();
						if (!historyExist.includes(stringSearch)) {
					history(stringSearch, numFile);
					}
					if ($('.content-search__append').find('.result-item').length == 0) {
						$('.content-search__append').html('<div class="content-search_err">Поиск не дал результата</div>')
					}
			   	},
			   	beforeSend: function(){
		    		$('.content-search__append').html('<div class="ajax-pre"><img src="https://otvet.imgsmail.ru/download/206009091_78ed8d53836e550217fe163db0742fa1_800.gif" alt="Preloader"></div>');
		    	},
			});
		}
		function history(sting, numFile){
			var templateHist = '<div class="child"><div class="history__item"><p class="history__item-name">' + sting + '</p><div class="history__item-feat"><p class="history__item-numfile">' + numFile + '</p></div></div></div>';
			var templateHist2 = '<div class="history__item"><p class="history__item-name">' + sting + '</p><div class="history__item-feat"><p class="history__item-numfile">' + numFile + '</p></div></div>';
			if ($('.history').find('.child').length == 0) {
				$('.history').append(templateHist)
			} else {
				if ($('.history__item').length >= 5) {
					$('.history__item:first').remove();
					$('.history .child').append(templateHist2);
				} else {
					$('.history .child').append(templateHist2);
				}
			}
			$('.history__item:last').click(function historyClick(){
				var nameVal = $(this).find('.history__item-name').html();
				$('.string-search').val(nameVal);
				$('.form input[type="submit"]').click();
			});
		}

	</script>



</body>
</html>







<div style="display: none;">
		<?				
		if(!empty($_POST)){
			$i=0;
			$string  = trim($_POST['stringSearch']);
			$time = microtime(true);
			$root='.';
			function path_file($file){
			
			$x=0;
			$Pfile = explode("/",$file);
			while ($x++<=count($Pfile)-3) $Patchfile.='/'.$Pfile[$x];
			return $Patchfile;
			}
			function path_throwgh_files($cdir)
			{
				global $PTF_Files;
				$files=glob($cdir.'/*');
				foreach($files as $file)
					if(is_dir($file))
						@path_throwgh_files($file);
						
					else 
						$PTF_Files[]=$file;
				return $PTF_Files;
			}

			echo '<div class="search-result">';
			
			foreach(@path_throwgh_files($root) as $file){
				$extention = end(explode('.', $file));
				if(strtolower($extention) == 'jpg' or
					strtolower($extention) == 'jpeg' or
					strtolower($extention) == 'png' or
					strtolower($extention) == 'gif' or
					strtolower($extention) == 'bmp' or
					strtolower($extention) == 'mp3' or
					strtolower($extention) == 'wav' or
					strtolower($extention) == 'flv' or
					strtolower($extention) == 'swf' or
					strtolower($extention) == 'ttf' or
					strtolower($extention) == 'doc' or
					strtolower($extention) == 'mov' or
					strtolower($extention) == 'mp4' or
					strtolower($extention) == 'gz' or
					strtolower($extention) == 'dat' or
					strtolower($extention) == 'zip')
					continue;
				if(filesize($file)<10000000
				&&stristr($file, 'cache')===FALSE
				&&stristr($file, 'upload')===FALSE
				) 
				{
					$format='';
					$formatFile = preg_replace('/.*(?=\.)\./', '', $file);
					switch ($formatFile) {
						case 'php':
							$colorFormat = '#b96565';
							break;

						case 'html':
							$colorFormat = '#736a54';
							break;

						case 'js':
							$colorFormat = '#946620';
							break;

						case 'css':
							$colorFormat = '#968530';
							break;

						case 'json':
							$colorFormat = '#883c19';
							break;

						case 'scss':
							$colorFormat = '#caab90';
							break;
						
						default:
							$colorFormat = '#000000';
							break;
					}
					if($_POST['fileSearch']!='')$format=$_POST['fileSearch'];
					if($_POST['formatSearch']!='')$format=$_POST['formatSearch'];
					if($_POST['fileSearch']=='all')$format='';
					if($format!=''&&strtolower($extention) == $format){
						$content=file_get_contents($file);
						$p = stristr($content,$string);
						if(!empty($p)){
							$i++; 
							$fileCopy = preg_replace('/[^\/]+$/', '', $file);
							$fileCopy = preg_replace('/^\./', '', $fileCopy);
						?>
							<div class="result-item"  onclick="copytext('#copytext<?php echo $i ?>')">
								<p class="result-item__uri"><?php print_r($file); ?></p>
								<div class="result-item__feat">
									<span class="result-item__format" style="background: <?php echo $colorFormat ?>;"><?php echo $formatFile ?></span>
									<div id="copytext<?php echo $i ?>" style="display: none;"><?php echo $fileCopy ?></div>
								</div>
							</div>
						<?php }
					}	
					if($format==''){
							$content=file_get_contents($file);
							$p = stristr($content,$string);
					
						if(!empty($p)){
							$i++;
							$fileCopy = preg_replace('/\.|[^\/]*\.(\w+)$/', '', $file);
							?>
							<div class="result-item" onclick="copytext('#copytext<?php echo $i ?>')">
								<p class="result-item__uri"><?php print_r($file); ?></p>
								<div class="result-item__feat">
									<span class="result-item__format" style="background: <?php echo $colorFormat ?>;"><?php echo $formatFile ?></span>
									<!-- <button class="result-item__cory"  onclick="copytext('#copytext<?php echo $i ?>')"></button> -->
									<div id="copytext<?php echo $i ?>" style="display: none;"><?php echo $fileCopy ?></div>
								</div>
							</div>
					<?php } 
					} 
				}
			}
			echo '</div>';
			?>


			<div class="info-search">
				<div class="child">
					<?php if ($format) { ?>
						<p>Расширение искомых файлов: <span class="color-red"><?php echo $format; ?></span></p>
					<?php } ?>
					<p>Время исполнения: <span class="color-red"><?php echo number_format((microtime(true)-$time), 3) ?></span> секунд.</p>
					<p>Всего файлов <span class="color-red num-file"><?php echo $i ?></span></p>
				<div>
			</div>


		<?php }
		?>
	</div>