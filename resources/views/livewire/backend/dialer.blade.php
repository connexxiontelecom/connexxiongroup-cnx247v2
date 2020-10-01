<div class="container">
    <form >
    <div class="row mb-3">
        <div class="col-md-12">
            <div id="dialer-screen">
            </div>
        </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button  value="1" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">1</button>
            </div>
            <div class="col-md-4">
                <button value="2" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">2</button>
            </div>
            <div class="col-md-4">
                <button value="3" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">3</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button value="4" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">4</button>
            </div>
            <div class="col-md-4">
                <button value="5" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">5</button>
            </div>
            <div class="col-md-4">
                <button value="6" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">6</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button value="7" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">7</button>
            </div>
            <div class="col-md-4">
                <button value="8" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">8</button>
            </div>
            <div class="col-md-4">
                <button value="9" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">9</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button value="*" disabled type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">*</button>
            </div>
            <div class="col-md-4">
                <button value="0" type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">0</button>
            </div>
            <div class="col-md-4">
                <button value="#" disabled type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">#</button>
            </div>
    </div>
    <div class="row mb-3">
            <div class="col-md-4">
                <button value="+" disabled type="button" class="pressNumberBtn btn btn-primary btn-outline-primary btn-icon" style="font-family: 'Oswald', sans-serif;">+</button>
            </div>
            <div class="col-md-4">
                <button  type="button"  id="makeCall" class="makeCall btn btn-primary btn-icon"><i class="zmdi zmdi-phone"></i></button>
                <button  type="button" style="display:none;" id="endCall" class="endCall btn btn-danger btn-icon"><i class="zmdi zmdi-phone-end"></i></button>
            </div>
            <div class="col-md-4">
                <button type="button" class="deleteNumberBtn btn btn-danger btn-icon"><i class="zmdi zmdi-long-arrow-left"></i></button>
            </div>
    </div>
    @if(session()->has('stage'))
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="label-main">
                    <label class="label label-inverse-info-border">{{ $call_progress }}</label>
                </div>
            </div>
        </div>
    @endif
</form>
</div>

@push('dialer-script')
<script>
    var screen = null;
    var phoneNumber = '';
    $(document).ready(function(){
        $(document).on('click', '.pressNumberBtn', function(e){
            var digit = $(this).val();
            updateContact(digit);
        });

        $(document).on('click', '.deleteNumberBtn', function(e){
            e.preventDefault();
            phoneNumber = phoneNumber.slice(0,-1);
            displayPhoneNumber();
        });
    });
    function updateContact(number){
        phoneNumber = phoneNumber + number;
        displayPhoneNumber();
    }
    function displayPhoneNumber() {
        $('#dialer-screen').text(phoneNumber);
    }
    function makeCall(){

    }






































  var speakerDevices = document.getElementById('speaker-devices');
  var ringtoneDevices = document.getElementById('ringtone-devices');
  var outputVolumeBar = document.getElementById('output-volume');
  var inputVolumeBar = document.getElementById('input-volume');
  var volumeIndicators = document.getElementById('volume-indicators');
  var callButton = document.getElementById('makeCall');
  callButton.disabled = true;
  var endCallButton = document.getElementById('endCall');
  callButton.disabled = true;
  log('Requesting Capability Token...');
  $.getJSON('https://auburn-bee-5518.twil.io/capability-token')
  //Paste URL HERE
    .done(function (data) {
      log('Got a token.');
      // Setup Twilio.Device
       Twilio.Device.setup(data.token);

      Twilio.Device.ready(function (device) {
        console.log('Twilio.Device Ready!');
        callButton.disabled = false;
      });

      Twilio.Device.error(function (error) {
        log('Twilio.Device Error: ' + error.message);
      });

      Twilio.Device.connect(function (conn) {
        //log('Successfully established call!');
        callButton.style.display = 'none';
        endCallButton.style.display = 'inline';
        //volumeIndicators.style.display = 'block';
        bindVolumeIndicators(conn);
      });

      Twilio.Device.disconnect(function (conn) {
        log('Call ended.');
        callButton.style.display = 'inline';
        endCallButton.style.display = 'none';

        //document.getElementById('button-call').style.display = 'inline';
        //document.getElementById('button-hangup').style.display = 'none';
        //volumeIndicators.style.display = 'none';
      }); 
/* 
      Twilio.Device.incoming(function (conn) {
        log('Incoming connection from ' + conn.parameters.From);
        var archEnemyPhoneNumber = '+12099517118';

        if (conn.parameters.From === archEnemyPhoneNumber) {
          conn.reject();
          log('It\'s your nemesis. Rejected call.');
        } else {
          // accept the incoming connection and start two-way audio
          conn.accept();
        }
      });

      setClientNameUI(data.identity);

      Twilio.Device.audio.on('deviceChange', updateAllDevices);

      // Show audio selection UI if it is supported by the browser.
      if (Twilio.Device.audio.isSelectionSupported) {
        document.getElementById('output-selection').style.display = 'block';
      } */
    })
    .fail(function () {
      log('Could not get a token from server!');
    });

  // Bind button to make call
  document.getElementById('makeCall').onclick = function () {
    // get the phone number to connect the call to
    var params = {
      To: phoneNumber//document.getElementById('phone-number').value
    };

    console.log('Calling ' + params.To + '...');
    Twilio.Device.connect(params);
  };

  // Bind button to hangup call
  document.getElementById('endCall').onclick = function () {
    log('Hanging up...');
    Twilio.Device.disconnectAll();
  };

/*   document.getElementById('get-devices').onclick = function() {
    navigator.mediaDevices.getUserMedia({ audio: true })
      .then(updateAllDevices);
  }; */

  /* speakerDevices.addEventListener('change', function() {
    var selectedDevices = [].slice.call(speakerDevices.children)
      .filter(function(node) { return node.selected; })
      .map(function(node) { return node.getAttribute('data-id'); });
    
    Twilio.Device.audio.speakerDevices.set(selectedDevices);
  });

  ringtoneDevices.addEventListener('change', function() {
    var selectedDevices = [].slice.call(ringtoneDevices.children)
      .filter(function(node) { return node.selected; })
      .map(function(node) { return node.getAttribute('data-id'); });
    
    Twilio.Device.audio.ringtoneDevices.set(selectedDevices);
  }); */

  function bindVolumeIndicators(connection) {
    connection.volume(function(inputVolume, outputVolume) {
      var inputColor = 'red';
      if (inputVolume < .50) {
        inputColor = 'green';
      } else if (inputVolume < .75) {
        inputColor = 'yellow';
      }

      inputVolumeBar.style.width = Math.floor(inputVolume * 300) + 'px';
      inputVolumeBar.style.background = inputColor;

      var outputColor = 'red';
      if (outputVolume < .50) {
        outputColor = 'green';
      } else if (outputVolume < .75) {
        outputColor = 'yellow';
      }

      outputVolumeBar.style.width = Math.floor(outputVolume * 300) + 'px';
      outputVolumeBar.style.background = outputColor;
    });
  }

  function updateAllDevices() {
    updateDevices(speakerDevices, Twilio.Device.audio.speakerDevices.get());
    updateDevices(ringtoneDevices, Twilio.Device.audio.ringtoneDevices.get());
  }

// Update the available ringtone and speaker devices
function updateDevices(selectEl, selectedDevices) {
  selectEl.innerHTML = '';
  Twilio.Device.audio.availableOutputDevices.forEach(function(device, id) {
    var isActive = (selectedDevices.size === 0 && id === 'default');
    selectedDevices.forEach(function(device) {
      if (device.deviceId === id) { isActive = true; }
    });

    var option = document.createElement('option');
    option.label = device.label;
    option.setAttribute('data-id', id);
    if (isActive) {
      option.setAttribute('selected', 'selected');
    }
    selectEl.appendChild(option);
  });
}

// Activity log
function log(message) {
  //var logDiv = document.getElementById('log');
  //logDiv.innerHTML += '<p>&gt;&nbsp;' + message + '</p>';
  //logDiv.scrollTop = logDiv.scrollHeight;
}

// Set the client name in the UI
function setClientNameUI(clientName) {
  var div = document.getElementById('client-name');
  div.innerHTML = 'Your client name: <strong>' + clientName +
    '</strong>';
}

</script>
@endpush