{capture assign=content}
    <article class="article-card">
        <img
            src="{$article.image}"
            alt="{$article.title}"
        >

        <h1 class="page-title">
            {$article.title}
        </h1>

        <p>
            {$article.description}
        </p>

        <p>
            {$article.content}
        </p>

        <p>
            Views: {$article.views}
        </p>
    </article>

    <section>
        <h2>
            Related Articles
        </h2>

        <div class="articles-list">
            {foreach $relatedArticles as $relatedArticle}
                <article class="article-card">
                    <img
                        src="{$relatedArticle.image}"
                        alt="{$relatedArticle.title}"
                    >

                    <h3>
                        {$relatedArticle.title}
                    </h3>

                    <p>
                        {$relatedArticle.description}
                    </p>

                    <p>
                        Views: {$relatedArticle.views}
                    </p>

                    <a
                        class="button"
                        href="/article?id={$relatedArticle.id}"
                    >
                        Read More
                    </a>
                </article>
            {/foreach}
        </div>
    </section>
{/capture}

{include file='layouts/main.tpl'}