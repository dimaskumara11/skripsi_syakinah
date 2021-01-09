<div class="col-md-4">
    <div class="panel panel-primary">

        <div class="panel-heading">
        <h3>KALENDER & JAM</h3>
        </div>

        <div class="panel-body px-2 mt-2">
            <div class="row">
                <div class="col-md-12">
                    <h3>Jam</h3>
                    <hr>
                    <p id="time"></p>
                </div>
                <div class="col-md-12">
                    <h3>Kalender</h3>
                    <hr>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push("add_js")
<script>
    var timeDisplay = document.getElementById("time");
    function refreshTime() {
    var dateString = new Date().toLocaleString("en-US", {timeZone: "America/Sao_Paulo"});
    var formattedString = dateString.replace(", ", " - ");
    timeDisplay.innerHTML = formattedString;
    }

    setInterval(refreshTime, 1000);
</script>
@endpush