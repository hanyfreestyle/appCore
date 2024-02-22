<script>
    @if($arFont)
    async function loadarfont(){
        const font_ar = new FontFace('Aljazeera','url({{ defWebAssets('fonts/Ar/Aljazeera.woff') }}');
        await font_ar.load();
        document.fonts.add(font_ar);
        document.body.classList.add('Aljazeera');
    };
    loadarfont();
    @endif

    @if($enFont )
    async function loadarfont_en(){
        const font_en = new FontFace('Poppins','url({{ defWebAssets('fonts/En/Inter-Regular.woff2') }}');
        await font_en.load();
        document.fonts.add(font_en);
        document.body.classList.add('Poppins');
    };
    loadarfont_en();
    @endif

    @if($fontawesome)
    async function fontawesome(){
        const fontawesome = new FontFace('FontAwesome','url({{ defWebAssets('fontawesome/fa-solid-900.woff2') }}');
        await fontawesome.load();
        document.fonts.add(fontawesome);
        document.body.classList.add('FontAwesome');
    };
    fontawesome();

    async function fontawesomeB(){
        const fontawesomeB = new FontFace('FontAwesomeB','url({{ defWebAssets('fontawesome/fa-brands-400.woff2') }}');
        await fontawesomeB.load();
        document.fonts.add(fontawesomeB);
        document.body.classList.add('FontAwesomeB');
    };
    fontawesomeB();
    @endif

{{--    @if($materialicon)--}}
{{--    async function materialOutlined(){--}}
{{--        const materialOutlined = new FontFace('MaterialOutlined','url({{ defWebAssets('material-icon/MaterialSymbolsOutlined.woff2') }}');--}}
{{--        await materialOutlined.load();--}}
{{--        document.fonts.add(materialOutlined);--}}
{{--        document.body.classList.add('MaterialOutlined');--}}
{{--    };--}}
{{--    materialOutlined();--}}
{{--    @endif--}}
</script>
