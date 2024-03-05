<script>
    CKEDITOR.replace('{{$name}}',
     {
         language: '{{$dir}}',
         height: {{$height}},
         toolbarGroups : [
             { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
             { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
             { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
             { name: 'insert', groups: [ 'insert' ] },
             { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
             { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
             { name: 'links', groups: [ 'links' ] },
             // '/',
             { name: 'colors', groups: [ 'colors' ] },
             { name: 'styles', groups: [ 'styles' ] },
             { name: 'tools', groups: [ 'tools' ] },
             // { name: 'others', groups: [ 'others' ] },
             // { name: 'about', groups: [ 'about' ] }
         ],

     });
    CKEDITOR.config.removeButtons = 'Save,NewPage,ExportPdf,Preview,Print,Templates,About,Smiley,SpecialChar,PageBreak,Iframe,Language,BidiRtl,BidiLtr,Subscript,Superscript,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Find,Replace,SelectAll,Scayt';
</script>