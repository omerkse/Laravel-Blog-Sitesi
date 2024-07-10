</div>
</div>

<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Blog Sitesi Admin Paneli {{date('Y')}}</span>
        </div>
    </div>
</footer>
</div>
</div>

<a class="scroll-to-top rounded" href="{{asset('back')}}/#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ayrılmaya Hazır?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Mevcut oturumunuzu sonlandırmaya hazırsanız aşağıdaki "Çıkış Yap"ı seçin.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
                <a class="btn btn-primary" href="{{route('admin.logout')}}">Çıkış Yap</a>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('back')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="{{asset('back')}}/js/sb-admin-2.min.js"></script>
<script src="{{asset('back')}}/vendor/chart.js/Chart.min.js"></script>
<script src="{{asset('back')}}/js/demo/chart-area-demo.js"></script>
<script src="{{asset('back')}}/js/demo/chart-pie-demo.js"></script>
<script src="{{asset('back')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('back')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('back')}}/js/demo/datatables-demo.js"></script>
<script src="{{ asset("back/vendor/bootstrap/js/bootstrap.bundle.js")  }}"></script>

@stack('js')
</body>
</html>
