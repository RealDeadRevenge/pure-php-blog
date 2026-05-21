{capture assign=content}
    <section>
        <h1 class="page-title">
            {$category.title}
        </h1>

        <p>
            {$category.description}
        </p>

        <div>
            <a
                class="button"
                href="/category?id={$category.id}&sort=date"
            >
                Sort by Date
            </a>

            <a
                class="button"
                href="/category?id={$category.id}&sort=views"
            >
                Sort by Views
            </a>
        </div>

        <div class="articles-list">
            {foreach $articles as $article}
                <article class="article-card">
                    <img
                        src="{$article.image}"
                        alt="{$article.title}"
                    >

                    <h2>
                        {$article.title}
                    </h2>

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

        <div class="pagination">
            {if $page > 1}
                <a
                    class="button"
                    href="/category?id={$category.id}&sort={$sort}&page={$page - 1}"
                >
                    Previous
                </a>
            {/if}

            <a
                class="button"
                href="/category?id={$category.id}&sort={$sort}&page={$page + 1}"
            >
                Next
            </a>
        </div>
    </section>
{/capture}

{include file='layouts/main.tpl'}
