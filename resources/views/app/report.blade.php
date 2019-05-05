@extends('layouts.app') 
@section('content')



<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Laporan</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="report-table">
                    <thead>
                        <tr class="thead-light">
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Langitude/Lotitude</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                </table>

            </div>
        </div>
    </div>
</div>
<script>
    var report = document.getElementById("report-table");
    var tbody = document.createElement("tbody");
    var no = 1;
    const dbRefObject = firebase.database().ref().child("data");
    
        console.log('s');
    dbRefObject.on('child_added', snap => {
        data = snap.val();
        date = snap.key;
        
        
        addData(date, data);
        notifikasi()
    });
        
                        dbRefObject.on('child_changed', snap => {
                            data = snap.val();
                            date = snap.key;
                            date1 = convert(date);
        
        addData(date, data);
                        });
                       
                        
                        dbRefObject.on('child_removed', snap => {
                           
                        });
    function addData(date1,data){

        date = convert(date1);

        var tr = document.createElement("tr");
        var tdNum = document.createElement("td");
        var tdDate = document.createElement("td");
        var tdLl = document.createElement("td");
        var tdDesc = document.createElement("td");
        var tdAction = document.createElement("td");                   
        
        var number = document.createTextNode(no);
        var date = document.createTextNode(date);
        var latLong = document.createTextNode(data.lat + "," + data.lng);
        var desc = document.createTextNode(data.status);
        var btnMaps = document.createElement('input');
        btnMaps.value = "Maps";
        btnMaps.className = "btn btn-danger";
        btnMaps.addEventListener("click", openMaps);

        function openMaps() {
        window.open("https://www.google.com/maps/dir//" + data.lat +","+data.lng);
        }

        var btnArc = document.createElement('input');
        btnArc.value = "Arsip";
        btnArc.className = "btn btn-primary";
        btnArc.addEventListener("click", archive, date);
        
        function archive(){
            reportRefObject.child(date1).once('value').then(snap => {
    console.log(snap.val());
    archiveRefObject.child(date1).set(snap.val());
    reportRefObject.child(date1).set(null);
    alert('Pengarsipan berhasil');
        window.location.reload();

   

})
        }
     
        tdAction.appendChild(btnMaps);
        tdAction.appendChild(btnArc);
        no++;
        tdNum.appendChild(number);
        tdDate.appendChild(date);
        tdLl.appendChild(latLong);
        tdDesc.appendChild(desc);
       
        tr.appendChild(tdNum);
        tr.appendChild(tdDate);
        tr.appendChild(latLong);
        tr.appendChild(tdDesc);
        tr.appendChild(tdAction);
        tbody.appendChild(tr);
        report.appendChild(tbody);
    }

    function convert(unixtimestamp){
        // Months array
        var months_arr = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

        // Convert timestamp to milliseconds
        var date = new Date(unixtimestamp*1000);

        // Year
        var year = date.getFullYear();

        // Month
        var month = months_arr[date.getMonth()];

        // Day
        var day = date.getDate();

        // Hours
        var hours = date.getHours();

        // Minutes
        var minutes = "0" + date.getMinutes();

        // Seconds
        var seconds = "0" + date.getSeconds();

        // Display date time in MM-dd-yyyy h:m:s format
        var convdataTime = month+'-'+day+'-'+year+' '+hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

        return convdataTime;
        }

</script>
@endsection