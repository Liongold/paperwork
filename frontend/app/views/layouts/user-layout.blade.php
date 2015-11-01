<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials/header-sidewide-meta')

    <!-- [[ HTML::style('css/bootstrap.min.css') ]] -->
    <!-- [[ HTML::style('css/bootstrap-theme.min.css') ]] -->

    [[ HTML::style('css/themes/paperwork-v1.min.css') ]]

    [[ HTML::style('css/freqselector.min.css') ]]

    [[ HTML::style('css/typeahead.min.css') ]]

    [[ HTML::style('css/mathquill.css')]]

    [[ HTML::style('css/libs.css') ]]

    [[ HTML::style('css/bootstrap-editable.css') ]]

</head>
<body ng-app="paperworkNotes">
@if (Setting::where('user_id', '=', Auth::user()->id)->first()->tour_current_step == 0)
<div class="modal fade" tabindex="-1" role="dialog" id="tour_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Welcome to Paperwork!</h4>
            </div>
            <div class="modal-body">
                <p>Welcome to Paperwork, your free and open source note taking application. In order to get up to speed, you can follow a tour around the Paperwork UI. Do you want to start it now?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="start_tour">Yes, let's start!</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No, not now</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="start_tour_cancel">No and don't show this to me again.</button>
            </div>
        </div>
    </div>
</div>
@endif
<div ng-controller="ConstructorController"></div>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">[[Lang::get('keywords.toggle_navigation')]]</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="paperwork-logo navbar-brand transition-effect" href="[[ URL::route("/") ]]"
                    ><img src="[[ asset('images/navbar-logo.png') ]]"> Paperwork</a>
        </div>
        <div class="navbar-collapse collapse">
            <div class="visible-xs">
                <form class="navbar-form" role="form">
                    <div class="form-group" ng-controller="SidebarNotebooksController">
                        <select class="form-control navbar-search" ng-model="notebookSelectedId"
                                ng-options="notebook.id as (notebook.title) for notebook in notebooks"
                                ng-change="openNotebook(notebookSelectedId,0,notebookSelectedId)">
                        </select>
                    </div>
                    <div class="form-group" ng-controller="NotesListController">
                        <select class="form-control navbar-search" ng-model="noteSelectedId.noteId"
                                ng-options="n.id as ((n.version.title || n.title)) for n in notes"
                                ng-change="openSelectedNote()">
                        </select>
                    </div>
                </form>
            </div>

            @if (array_key_exists('HTTP_USER_AGENT', $_SERVER) && preg_match('/Paperwork for Mac/', $_SERVER['HTTP_USER_AGENT']) === 0)
                @include('partials/menu-main')
            @endif

            @include('partials/search-main')

            @include('partials/navigation-main')
        </div>
    </div>
</div>

@yield("content")

<div class="container-fluid">
    <div class="footer footer-issue [[ Config::get('paperwork.showIssueReportingLink') ? '' : 'hide' ]]">
        @include('partials/error-reporting-footer')
    </div>
</div>

[[ HTML::script('js/jquery.min.js') ]]

[[ HTML::script('ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') ]]
[[ HTML::script('js/angular.min.js') ]]

[[ HTML::script('js/paperwork.min.js') ]]
[[ HTML::script('js/paperwork-native.min.js') ]]

[[ HTML::script('js/bootstrap.min.js') ]]
[[ HTML::script('js/tagsinput.min.js') ]]
[[ HTML::script('js/libraries.min.js') ]]

[[ HTML::script('ckeditor/ckeditor.js') ]]

[[-- HTML::script('js/bootstrap-editable.min.js') --]]
[[-- HTML::script('//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js') --]]

<script type="text/javscript">
var currentStep = [[ Setting::where('user_id', '=', Auth::user()->id)->first()->tour_current_step ]];
</script>
[[ HTML::script('js/tour.min.js') ]]

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
[[ HTML::script('js/ltie9compat.min.js') ]]
<![endif]-->
<!--[if lt IE 11]>
[[ HTML::script('js/ltie11compat.js') ]]
<![endif]-->

</body>
</html>
