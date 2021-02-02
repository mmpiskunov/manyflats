<{{ '?' }}xml version="1.0" encoding="UTF-8" {{ '?' }}>
    <rss version="2.0"
         xmlns:content="http://purl.org/rss/1.0/modules/content/"
         xmlns:wfw="http://wellformedweb.org/CommentAPI/"
         xmlns:dc="http://purl.org/dc/elements/1.1/"
         xmlns:atom="http://www.w3.org/2005/Atom"
         xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
         xmlns:slash="http://purl.org/rss/1.0/modules/slash/">

        <channel>
            <title>{{ trans('feeds/feed.title') }}</title>
            <atom:link href="{{ trans('feeds/feed.atom_link') }}" rel="self" type="application/rss+xml"/>
            <link>{{ trans('feeds/feed.link') }}</link>
            <description>{{ trans('feeds/feed.description') }}</description>
            @if ($lastDate) <lastBuildDate>{{ $lastDate }}</lastBuildDate> @endif
            <language>{{ trans('feeds/feed.language') }}</language>
            <sy:updatePeriod>hourly</sy:updatePeriod>
            <sy:updateFrequency>1</sy:updateFrequency>
            <generator>https://wordpress.org/?v=5.3.2</generator>
            {{--
            <image>
                <url>https://edimdoma.pro/wp-content/uploads/2019/12/cropped-logo-32x32.png</url>
                <title>Едим Дома</title>
                <link>
                https://edimdoma.pro</link>
                <width>32</width>
                <height>32</height>
            </image>
            --}}

        @foreach ($items as $item)
                <item>
                    <title>{{ $item['title'] }}</title>
                    <link>{{ $item['page_link'] }}</link>
                    <pubDate>{{ Carbon\Carbon::parse($item['created_at'])->format("D, j M Y H:i:s O") }}</pubDate>
                    <dc:creator><![CDATA[{{trans('feeds/feed.creator')}}]]></dc:creator>
                    <category><![CDATA[{{trans('feeds/feed.properties')}}]]></category>
                    <guid isPermaLink="false">https://manyflats.com/feed/{{ $item['language'] }}/link/{{ $item['feed_id'] }}</guid>
                    <description><![CDATA[{{ strip_tags($item['content'] ?? '') }}]]></description>
                    <content:encoded><![CDATA[
                        <div class="flat_pm_start"></div>

                        {!! $item['content'] ?? '' !!}
                        <p><span class="detailed_full"></p>
                        <h2 class="span">{{ $item['title'] }}</h2>
                        <div class="cleaner"></div>
                        <div itemprop="recipeInstructions" itemtype="http://schema.org/ItemList" itemscope="">
                            <div class="detailed_step_photo_big"><img
                                    src="{{ $item['image'] ?? '' }}"/>
                            </div>
                            <div class="detailed_step_description_big">{{trans('feeds/feed.detailed')}}</div>
                        <div class="cleaner"></div>
                        <div class="flat_pm_end"></div>
                        ]]>
                    </content:encoded>
                    {{--
                    <image>{{ $item['image'] ?? '' }}</image>
                    <comments></comments>
                    <category><![CDATA[Новичкам]]></category>
                    <wfw:commentRss>https://blog.smmbox.com/novichkam/rabota-s-liderami-mneniy-dlya-biznesa.php/feed</wfw:commentRss>
                    <slash:comments>0</slash:comments>
                    --}}
                </item>
            @endforeach
        </channel>
    </rss>
