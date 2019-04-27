$(document).ready(() => {
    const makeCode = (lectureId, nextScanId) => {
        const qrcode = new QRCode($("#qrcode")[0], {
            width : 200,
            height : 200
        });
        if (lectureId && nextScanId) {
            qrcode.makeCode(`api/attendances/register/${lectureId}/${nextScanId}`);
        }
    };
    const lectureId = $("#lectureId").val();
    const nextScanId = $("#nextScanId").val();
    makeCode(lectureId, nextScanId);
    Echo.private('dodo')
        .listen('TestEvent', (event) => {
            console.log(event);
            console.log(1);
            makeCode($("#lectureId").val(), event.next_scan_id);

        });
});
