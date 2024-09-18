
<footer class="footer">
        <span class="text-left">
            <a href="http://coreui.io">CoreUI</a> &copy; 2016 creativeLabs.
        </span>
        <span class="pull-right">
            Powered by <a href="http://coreui.io">CoreUI</a>
        </span>
    </footer>
    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset('adminassets/js/libs/jquery.min.js')}}"></script>
    <script src="{{asset('adminassets/js/libs/tether.min.js')}}"></script>
    <script src="{{asset('adminassets/js/libs/bootstrap.min.js')}}"></script>
    <script src="{{asset('adminassets/js/libs/pace.min.js')}}"></script>

    <!-- Plugins and scripts required by all views -->
    <script src="{{asset('adminassets/js/libs/Chart.min.js')}}"></script>

    <!-- CoreUI main scripts -->

    <script src="{{asset('adminassets/js/app.js')}}"></script>

    <!-- Plugins and scripts required by this views -->
    <!-- Custom scripts required by this view -->
    <script src="{{asset('adminassets/js/views/main.js')}}"></script>

    <!-- Grunt watch plugin -->
    <script src="//localhost:35729/livereload.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
<script type="module">
    import ClassicEditor from 'https://cdn.ckeditor.com/ckeditor5/43.0.0/classic/ckeditor.js';

    document.addEventListener('DOMContentLoaded', function () {
        var editorIds = document.querySelectorAll('[id^=editor-]');
        editorIds.forEach(function (textarea) {
            ClassicEditor
                .create(textarea)
                .then(editor => {
                    console.log('Editor was initialized', editor);
                })
                .catch(error => {
                    console.error('There was a problem initializing the editor:', error);
                });
        });
    });
</script>




    

</body>

</html>
