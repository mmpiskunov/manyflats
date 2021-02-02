@if(!config('app.debug'))
<script language="javascript"><!--
    d=document;var a='';a+=';r='+escape(d.referrer);js=10;//--></script>
<script language="javascript1.1"><!--
a+=';j='+navigator.javaEnabled();js=11;//--></script>
<script language="javascript1.2"><!--
    s=screen;a+=';s='+s.width+'*'+s.height;
    a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;//--></script>
<script language="javascript1.3"><!--
js=13;//--></script><script language="javascript" type="text/javascript"><!--
    d.write('<img src="https://counter.inkapi.net/s/counter.php'+'?id=manyflats.com;js='+js+
        a+';rand='+Math.random()+';admin=0;group=0" height=1 width=1 style="width:1px;height:1px;opacity:.1;filter:alpha(opacity=10);" alt="" border=0>');
    if(11<js)d.write('<'+'!-- ');//--></script>
<noscript><img src="https://counter.inkapi.net/s/counter.php?id=manyflats.com;js=na;"
               height=1 width=1 alt="" style="width:1px;height:1px;opacity:.1;filter:alpha(opacity=10);" border=0></noscript>
<script language="javascript" type="text/javascript"><!--
    if(11<js)d.write('--'+'>');//--></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(62179063, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/62179063" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
@endif
