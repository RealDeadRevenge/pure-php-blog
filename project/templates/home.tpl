{capture assign=content}
    <h1 class="page-title">
        Categories
    </h1>

    {foreach $categories as $category}
        <section>
            <h2>
                {$category.title}
            </h2>

            <p>
                {$category.description}
            </p>

            <a
                class="button"
                href="/category?id={$category.id}"
            >
                All Articles
            </a>

            <div class="articles-list">
                {foreach $category.articles as $article}
                    <article class="article-card">
                        <img
                            src="{$article.image}"
                            alt="{$article.title}"
                        >

                        <h3>
                            {$article.title}
                        </h3>

                        <p>
                            {$article.description}
                        </p>

                        <p>
                            Views: {$article.views}
                        </p>

                        <a
                            class="button"
                            href="/article?id={$article.id}"
                        >
                            Read More
                        </a>
                    </article>
                {/foreach}
            </div>
        </section>
    {/foreach}
{/capture}

{include file='layouts/main.tpl'}