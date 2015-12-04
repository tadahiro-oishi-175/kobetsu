$(document).ready(function () {
    $('#tags').tagit({
        fieldName: "tags",
        singleField: true,
        tagSource: ["c++", "java", "php", "javascript", "ruby", "python"],
        readOnly: true,
        sortable: 'handle',
        afterTagAdded: function () {
            //window.alert();
            //$(this).find('li').addClass('customStyle');
        }
    });
});