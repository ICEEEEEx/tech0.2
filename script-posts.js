document.addEventListener('DOMContentLoaded', function () {
    const postsContainer = document.getElementById('postContainer');
    const moreBtn = document.getElementById('moreBtn');
    const hideBtn = document.getElementById('hideBtn');
    let currentPage = 1;
    let posts = []; // Store all posts here

    function displayPosts(posts) {
        const startIndex = (currentPage - 1) * 3;
        const endIndex = startIndex + 3;
        const currentPosts = posts.slice(startIndex, endIndex);

        currentPosts.forEach(post => {
            const postElement = document.createElement('div');
            postElement.classList.add('card');
            postElement.innerHTML = `
                <div class="card-header">
                    <img src="logo.png" alt="Avatar" class="avatar">
                    <div class="user-info">
                        <h3>${post.username}</h3>
                        <p class="timestamp">${post.timestamp}</p>
                    </div>
                </div>
                <div class="message-content">
                    <p>${post.message}</p>
                </div>
            `;
            postsContainer.appendChild(postElement);
        });

        // Check if there are more posts to display
        if (posts.length > endIndex) {
            moreBtn.style.display = 'inline-block';
        } else {
            moreBtn.style.display = 'none';
        }
    }

    function loadPosts() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'Jsons/posts.json', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                posts = JSON.parse(xhr.responseText);
                displayPosts(posts);
            }
        };
        xhr.send();
    }

    function loadMorePosts() {
        currentPage++;
        loadPosts();
        hideBtn.style.display = 'inline-block'; // Show the "hide" button when "more" is clicked
    }

    function hideExtraPosts() {
        currentPage = 1;
        postsContainer.innerHTML = '';
        loadPosts();
        hideBtn.style.display = 'none';
        moreBtn.style.display = 'inline-block';
    }

    moreBtn.addEventListener('click', loadMorePosts);
    hideBtn.addEventListener('click', hideExtraPosts);

    loadPosts();
});
