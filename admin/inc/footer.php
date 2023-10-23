 <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
        <p>
         &copy; Copyright <a href="index.php">SGHGROUP COMPANY</a>. All Rights Reserved.
        </p>
    </div>
 
 


    <script>
        $( function() {
            $( "datepicker_from" ).datepicker({
                dateFormat: 'dd/mm/yy',
                duration: "slow"
            });
            $( "datepicker_to" ).datepicker({
                dateFormat: 'dd/mm/yy',
                duration: "slow"
            });
        } );
    </script>
    <script>
        $(document).ready(function()){
            new Morris.Bar({
                element: 'myfirstchart',
                data: [
                    {date: '10/10/2019', value: 20,revenue: 300, quantity:20},
                    {date: '10/10/2019', value: 20,revenue: 300, quantity:20},
                    {date: '10/10/2019', value: 20,revenue: 300, quantity:20},
                    {date: '10/10/2019', value: 20,revenue: 300, quantity:20},
                    {date: '10/10/2019', value: 20,revenue: 300, quantity:20}
                ],
                xkey: 'date',
                ykey: ['value', 'revenue', 'quantity'],
                labels: ['Số Đơn Hàng', 'Doanh thu', 'Số lượng']
            });
            function day365(){

            }
        }
    </script>
</body>
</html>
