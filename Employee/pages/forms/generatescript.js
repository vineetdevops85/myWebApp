document.getElementById('generateBtn').addEventListener('click', function() {
    // Get values from input fields and dropdown
    var siteid = document.querySelector('input[name="siteid"]').value;
    var fdd = document.querySelector('input[name="fdd"]').value;
    var antennagroup = document.querySelector('select[name="antennagroup"]').value;
    var sectorequipement = document.querySelector('input[name="sectorequipement"]').value;
    var sectorcarrier = document.querySelector('input[name="sectorcarrier"]').value;
    var radio = document.querySelector('input[name="radio"]').value;
    var radioport = document.querySelector('select[name="radioport"]').value;
    var xmubbu = document.querySelector('select[name="xmubbu"]').value;
    var riport = document.querySelector('select[name="riport"]').value;
    var rilink = document.querySelector('input[name="rilink"]').value;
    var a = document.querySelector('input[name="a"]').value;
    var b = document.querySelector('input[name="b"]').value;
    var c = document.querySelector('input[name="c"]').value;
    var d = document.querySelector('input[name="d"]').value;
    var ul = document.querySelector('input[name="ul"]').value;
    var dl = document.querySelector('input[name="dl"]').value;
    var uldelay = document.querySelector('input[name="uldelay"]').value;
    var dldelay = document.querySelector('input[name="dldelay"]').value;
    
    // Get current date
    var currentDate = new Date();
    var dateString = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
    
    // Construct the filename
    var filename = siteid + '_' + fdd + '_' + dateString + '.txt';
    
    // Construct the string
    var text = `SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},NodeSupport=1,SectorEquipmentFunction=${sectorequipement}"
administrativeState : LOCKED

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},NodeSupport=1,SectorEquipmentFunction=${sectorequipement}"
rfBranchRef : []

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},ENodeBFunction=1,SectorCarrier=${sectorcarrier}"
rfBranchRxRef : []
rfBranchTxRef : []

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},NodeSupport=1,CpriLinkIqData=1"
riLinkRef : []

DELETE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,RiLink=${rilink}"

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${a}"
rfPortRef : <empty>

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${b}"
rfPortRef : <empty>

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio}"
administrativeState : LOCKED

DELETE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio}"

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio}"
fieldReplaceableUnitId : "${radio}"

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},AlarmPort=1"
alarmPortId : "1"

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},AlarmPort=2"
alarmPortId : "2"

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RfPort=A"
administrativeState : UNLOCKED
rfPortId : "A"
vswrSupervisionActive : true
vswrSupervisionSensitivity : 70

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RfPort=B"
administrativeState : UNLOCKED
rfPortId : "B"
vswrSupervisionActive : true
vswrSupervisionSensitivity : 70

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RfPort=C"
administrativeState : UNLOCKED
rfPortId : "C"
vswrSupervisionActive : true
vswrSupervisionSensitivity : 70

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RfPort=D"
administrativeState : UNLOCKED
rfPortId : "D"
vswrSupervisionActive : true
vswrSupervisionSensitivity : 70

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RfPort=R"
administrativeState : UNLOCKED
rfPortId : "R"

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RiPort=DATA_1"
riPortId : "DATA_1"

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RiPort=DATA_2"
riPortId : "DATA_2"

CREATE
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,RiLink=${rilink}"
riLinkId : "${rilink}"
riPortRef1 : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=1,${xmubbu}=${riport}"
riPortRef2 : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RiPort=${radioport}"

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${a}"
rfPortRef : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RfPort=A"

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${b}"
rfPortRef : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RfPort=C"

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${c}"
dlAttenuation : [${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}]
dlTrafficDelay : [${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}]
rfPortRef : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RfPort=B"
ulAttenuation : [${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}]
ulTrafficDelay : [${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}]

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${d}"
dlAttenuation : [${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}, ${dl}]
dlTrafficDelay : [${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}, ${dldelay}]
rfPortRef : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio},RfPort=D"
ulAttenuation : [${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}, ${ul}]
ulTrafficDelay : [${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}, ${uldelay}]

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},ENodeBFunction=1,SectorCarrier=${antennagroup}"
configuredMaxTxPower : 160000
noOfRxAntennas : 4
noOfTxAntennas : 4
rfBranchRxRef : ["SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${a}", "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${b}", "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${c}", "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${d}"]
rfBranchTxRef : ["SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${a}", "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${b}", "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${c}", "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${d}"]

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},NodeSupport=1,SectorEquipmentFunction=${sectorequipement}"
rfBranchRef : ["SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${a}", "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${b}", "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${c}", "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,AntennaUnitGroup=${antennagroup},RfBranch=${d}"]

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},Equipment=1,FieldReplaceableUnit=${radio}"
administrativeState : UNLOCKED

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},NodeSupport=1,SectorEquipmentFunction=${sectorequipement}"
administrativeState : UNLOCKED

SET
FDN : "SubNetwork=ONRM_ROOT_MO_MeContext=${siteid},ManagedElement=${siteid},ENodeBFunction=1,EUtranCellFDD=${fdd}"
administrativeState : UNLOCKED`;

    // Create a Blob containing the text content
    var blob = new Blob([text], { type: 'text/plain' });

    // Create a URL for the Blob
    var url = window.URL.createObjectURL(blob);

    // Create a link element to trigger the download
    var a = document.createElement('a');
    a.href = url;
    a.download = filename; // Set the filename
    document.body.appendChild(a);

    // Trigger the click event to initiate the download
    a.click();

    // Revoke the URL to free up memory
    window.URL.revokeObjectURL(url);

    // Remove the link element
    document.body.removeChild(a);
});
