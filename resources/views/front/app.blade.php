<!DOCTYPE html>
<html lang="en" prefix="og:http://ogp.me/ns#">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="robots" content="follow">
    <meta name="author" content="Fordyce Gozali">
    <meta name="contact" content="forddyce92@gmail.com">
    <meta name="description" content="">
    <link rel="shortcun icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon" />
    <link href="{{ \URL::current() }}" rel="canonical">
    <meta name="_t" content="{{ csrf_token() }}" />
    <link rel="alternate" href="{{ \URL::current() }}" hreflang="x-default" />
    <link rel="stylesheet" type="text/css" media="screen" title="style (screen)" href="{{ asset('assets/css/front/plugins.css?v='.filemtime(public_path().'/assets/css/front/plugins.css')) }}" />
    <link rel="stylesheet" type="text/css" media="screen" title="style (screen)" href="{{ asset('assets/css/front/theme.css?v='.filemtime(public_path().'/assets/css/front/theme.css')) }}" />
    <title>@yield('title', config('app.name'))</title>
    <script>
      (function(e,t){typeof module!="undefined"&&module.exports?module.exports=t():typeof define=="function"&&define.amd?define(t):this[e]=t()})("$script",function(){function p(e,t){for(var n=0,i=e.length;n<i;++n)if(!t(e[n]))return r;return 1}function d(e,t){p(e,function(e){return!t(e)})}function v(e,t,n){function g(e){return e.call?e():u[e]}function y(){if(!--h){u[o]=1,s&&s();for(var e in f)p(e.split("|"),g)&&!d(f[e],g)&&(f[e]=[])}}e=e[i]?e:[e];var r=t&&t.call,s=r?t:n,o=r?e.join(""):t,h=e.length;return setTimeout(function(){d(e,function t(e,n){if(e===null)return y();e=!n&&e.indexOf(".js")===-1&&!/^https?:\/\//.test(e)&&c?c+e+".js":e;if(l[e])return o&&(a[o]=1),l[e]==2?y():setTimeout(function(){t(e,!0)},0);l[e]=1,o&&(a[o]=1),m(e,y)})},0),v}function m(n,r){var i=e.createElement("script"),u;i.onload=i.onerror=i[o]=function(){if(i[s]&&!/^c|loade/.test(i[s])||u)return;i.onload=i[o]=null,u=1,l[n]=2,r()},i.async=1,i.defer=1,i.src=h?n+(n.indexOf("?")===-1?"?":"&")+h:n,t.insertBefore(i,t.lastChild)}var e=document,t=e.getElementsByTagName("head")[0],n="string",r=!1,i="push",s="readyState",o="onreadystatechange",u={},a={},f={},l={},c,h;return v.get=m,v.order=function(e,t,n){(function r(i){i=e.shift(),e.length?v(i,r):v(i,t,n)})()},v.path=function(e){c=e},v.urlArgs=function(e){h=e},v.ready=function(e,t,n){e=e[i]?e:[e];var r=[];return!d(e,function(e){u[e]||r[i](e)})&&p(e,function(e){return u[e]})?t():!function(e){f[e]=f[e]||[],f[e][i](t),n&&n(r)}(e.join("|")),v},v.done=function(e){v([null],e)},v})
    </script>
    <!--googleoff: index-->
    <script type="text/javascript">
      var App = {};
      window._root = '{{ URL::to("/") }}';
      window._adminUrl = '{{ config('app.adminUrl') }}';
      App.Scripts = {
        core: [
          window._root + '/lib/jquery.js'
        ],
        bundle_dep: [
          window._root + '/lib/jquery-migrate.js',
          window._root + '/lib/modernizr.js',
          window._root + '/lib/bootstrap.js',
          window._root + '/assets/js/front/theme.js?v=' + {{ filemtime(public_path().'/assets/js/front/theme.js') }},
        ],
        bundle: [
          window._root + '/lib/cache2.js',
          window._root + '/assets/js/front/index.js?v=' + {{ filemtime(public_path().'/assets/js/front/index.js') }}
        ]
      };

      window._dataTablesLang = {
        "decimal": '{{ \Lang::get('datatable.decimal') }}',
        "emptyTable": '{{ \Lang::get('datatable.empty') }}',
        "info": '{{ \Lang::get('datatable.info') }}',
        "infoEmpty": '{{ \Lang::get('datatable.infoEmpty') }}',
        "infoFiltered": '{{ \Lang::get('datatable.infoFilter') }}',
        "infoPostFix": '{{ \Lang::get('datatable.infoPostfix') }}',
        "thousands": '{{ \Lang::get('datatable.thousands') }}',
        "lengthMenu": '{{ \Lang::get('datatable.lengthMenu') }}',
        "loadingRecords": '{{ \Lang::get('datatable.loadingRecords') }}',
        "processing": '{{ \Lang::get('datatable.processing') }}',
        "search": '{{ \Lang::get('datatable.search') }}',
        "zeroRecords": '{{ \Lang::get('datatable.zeroRecords') }}',
        "paginate": {
          "first": '{{ \Lang::get('datatable.paginate.first') }}',
          "last": '{{ \Lang::get('datatable.paginate.last') }}',
          "next": '{{ \Lang::get('datatable.paginate.next') }}',
          "previous": '{{ \Lang::get('datatable.paginate.previous') }}'
        },
        "aria": {
          "sortAscending": '{{ \Lang::get('datatable.aria.asc') }}',
          "sortDescending": '{{ \Lang::get('datatable.aria.desc') }}'
        }
      };

      $script(App.Scripts.core, "core");

      $script.ready(["core"], function() {
        $script(App.Scripts.bundle_dep, "bundle_dep");
      });

      $script.ready(["core", "bundle_dep"], function() {
        $script(App.Scripts.bundle, "bundle");
      });
    </script>
    <!--googleon: index-->
  </head>

  <?php $route = \Route::currentRouteName(); ?>
  <body @if ($route == 'login' || $route == 'logout') class="page-login" init-ripples="" @elseif (is_null($route)) class="page-error" @else scroll-spy="" id="top" class=" theme-template-dark theme-pink alert-open alert-with-mat-grow-top-right" @endif>
    @if (session()->has('flashMessage'))
      <?php $msg = session('flashMessage'); ?>
      @if (isset($msg['class']) && isset($msg['message']))
      <div class="alert alert-fixed alert-{{ $msg['class'] }}">
        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
        {{ $msg['message'] }}
      </div>
      @endif
    @endif

    <div id="pageLoader">
      <span class="md-refresh md-spin"></span>
    </div>
    
    <!--[if IE]>
      <div class="alert alert-fixed alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
        This web is best viewed with Firefox (<a href="https://www.mozilla.org/en-US/firefox/new/" target="_blank">download</a>) or Chrome (<a href="https://www.google.com/chrome/browser/desktop/" target="_blank">download</a>).
      </div>
    <![endif]-->

    @yield('content')

    <!--[if IE]>
      <script type="text/javascript" src="{{ asset('lib/html5shiv.js') }}"></script>
      <script type="text/javascript" src="{{ asset('lib/respond.js') }}"></script>
    <![endif]-->
  </body>
</html>
