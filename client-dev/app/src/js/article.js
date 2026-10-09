export function initArticleReadMore() {
    document.querySelectorAll('[data-article-read-more]').forEach((article) => {
        const body = article.querySelector('.single-article__body');
        const toggle = article.querySelector('[data-article-read-more-toggle]');
        const label = article.querySelector('[data-article-read-more-label]');

        if (!(body instanceof HTMLElement) || !(toggle instanceof HTMLButtonElement) || !(label instanceof HTMLElement)) {
            return;
        }

        body.classList.add('is-collapsed');
        toggle.hidden = false;
        toggle.addEventListener('click', () => {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!isExpanded));
            body.classList.toggle('is-collapsed', isExpanded);
            label.textContent = isExpanded ? toggle.dataset.collapsedLabel : toggle.dataset.expandedLabel;
        });
    });
}

export function initArticleEngagement() {
    const engagement = document.querySelector('[data-post-engagement]');
    const config = window.futuretechEngagement;
    const status = engagement?.querySelector('[data-engagement-status]');

    if (!(engagement instanceof HTMLElement) || !(status instanceof HTMLElement) || !config?.ajaxUrl || !config.nonce) {
        return;
    }

    const formatCount = (count) => {
        if (count >= 1000000) {
            return `${Math.round(count / 100000) / 10}m`;
        }
        if (count >= 1000) {
            return `${Math.round(count / 100) / 10}k`;
        }

        return String(count);
    };

    const updateCounts = (counts) => {
        Object.entries(counts).forEach(([event, count]) => {
            const output = engagement.querySelector(`[data-engagement-count="${event}"]`);
            if (output instanceof HTMLElement) {
                output.textContent = formatCount(Number(count));
            }
        });
    };

    const sendEvent = async (event) => {
        const formData = new URLSearchParams({
            action: 'futuretech_post_engagement',
            nonce: config.nonce,
            postId: engagement.dataset.postId || '',
            event,
        });
        const response = await fetch(config.ajaxUrl, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData,
        });
        const result = await response.json();

        if (!response.ok || !result.success) {
            throw new Error(result.data?.message || config.errors?.request);
        }

        updateCounts(result.data.counts);
        return result.data;
    };

    engagement.querySelectorAll('[data-engagement-action]').forEach((button) => {
        if (!(button instanceof HTMLButtonElement)) {
            return;
        }

        button.addEventListener('click', async () => {
            const event = button.dataset.engagementAction;
            button.disabled = true;
            status.textContent = '';

            try {
                if (event === 'like') {
                    const result = await sendEvent('like');
                    button.setAttribute('aria-pressed', String(result.liked));
                    button.classList.toggle('is-active', result.liked);
                    status.textContent = result.liked ? config.errors?.likeAdded : config.errors?.likeRemoved;
                } else if (event === 'share') {
                    if (typeof navigator.share === 'function') {
                        await navigator.share({
                            title: document.title,
                            url: window.location.href,
                        });
                    } else if (navigator.clipboard?.writeText) {
                        await navigator.clipboard.writeText(window.location.href);
                    } else {
                        throw new Error(config.errors?.share);
                    }

                    await sendEvent('share');
                    status.textContent = config.errors?.shareComplete;
                }
            } catch (error) {
                if (error instanceof Error && error.name === 'AbortError') {
                    return;
                }
                status.textContent = error instanceof Error ? error.message : config.errors?.request;
            } finally {
                button.disabled = false;
            }
        });
    });

    sendEvent('view').catch((error) => {
        status.textContent = error instanceof Error ? error.message : config.errors?.request;
    });
}
