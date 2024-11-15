import {posts} from './posts.js';

const template = document.createElement('template');

template.innerHTML = `
<style>
@import url('/css/blog.css');
@import url('/css/button.css');
</style>
 <svg width="0" height="0" display="none">

      <symbol id="github" viewBox="0 0 24 24">
        <path d="M12 0.297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385 0.6 0.113 0.82-0.258 0.82-0.577 0-0.285-0.010-1.040-0.015-2.040-3.338 0.724-4.042-1.61-4.042-1.61-0.546-1.385-1.335-1.755-1.335-1.755-1.087-0.744 0.084-0.729 0.084-0.729 1.205 0.084 1.838 1.236 1.838 1.236 1.070 1.835 2.809 1.305 3.495 0.998 0.108-0.776 0.417-1.305 0.76-1.605-2.665-0.3-5.466-1.332-5.466-5.93 0-1.31 0.465-2.38 1.235-3.22-0.135-0.303-0.54-1.523 0.105-3.176 0 0 1.005-0.322 3.3 1.23 0.96-0.267 1.98-0.399 3-0.405 1.020 0.006 2.040 0.138 3 0.405 2.28-1.552 3.285-1.23 3.285-1.23 0.645 1.653 0.24 2.873 0.12 3.176 0.765 0.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92 0.42 0.36 0.81 1.096 0.81 2.22 0 1.606-0.015 2.896-0.015 3.286 0 0.315 0.21 0.69 0.825 0.57 4.801-1.574 8.236-6.074 8.236-11.369 0-6.627-5.373-12-12-12z"></path>
      </symbol>
    
      <symbol id="twitter" viewBox="0 0 24 24">
        <path fill="#1da1f2" style="fill: var(--color1, #1da1f2)" d="M23.954 4.569c-0.885 0.389-1.83 0.654-2.825 0.775 1.014-0.611 1.794-1.574 2.163-2.723-0.951 0.555-2.005 0.959-3.127 1.184-0.896-0.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 0.39 0.045 0.765 0.127 1.124-4.090-0.193-7.715-2.157-10.141-5.126-0.427 0.722-0.666 1.561-0.666 2.475 0 1.71 0.87 3.213 2.188 4.096-0.807-0.026-1.566-0.248-2.228-0.616v0.061c0 2.385 1.693 4.374 3.946 4.827-0.413 0.111-0.849 0.171-1.296 0.171-0.314 0-0.615-0.030-0.916-0.086 0.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-0.39 0-0.779-0.023-1.17-0.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-0.209 0-0.42-0.015-0.63 0.961-0.689 1.8-1.56 2.46-2.548l-0.047-0.020z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="apps">
        <path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="arrow_back">
        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="arrow_forward">
        <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="assignment">
        <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="check">
        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="chrome_reader_mode">
        <path d="M13 12h7v1.5h-7zm0-2.5h7V11h-7zm0 5h7V16h-7zM21 4H3c-1.1 0-2 .9-2 2v13c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 15h-9V6h9v13z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="close">
        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="code">
        <path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="devices_other">
        <path d="M3 6h18V4H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4v-2H3V6zm10 6H9v1.78c-.61.55-1 1.33-1 2.22s.39 1.67 1 2.22V20h4v-1.78c.61-.55 1-1.34 1-2.22s-.39-1.67-1-2.22V12zm-2 5.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM22 8h-6c-.5 0-1 .5-1 1v10c0 .5.5 1 1 1h6c.5 0 1-.5 1-1V9c0-.5-.5-1-1-1zm-1 10h-4v-8h4v8z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="favorite">
        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="home">
        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="info_outline">
        <path d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="insert_comment">
        <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="insert_emoticon">
        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="insert_link">
        <path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="menu">
        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="note">
        <path d="M22 10l-6-6H4c-1.1 0-2 .9-2 2v12.01c0 1.1.9 1.99 2 1.99l16-.01c1.1 0 2-.89 2-1.99v-8zm-7-4.5l5.5 5.5H15V5.5z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="picture_in_picture">
        <path d="M19 7h-8v6h8V7zm2-4H3c-1.1 0-2 .9-2 2v14c0 1.1.9 1.98 2 1.98h18c1.1 0 2-.88 2-1.98V5c0-1.1-.9-2-2-2zm0 16.01H3V4.98h18v14.03z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="share">
        <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="star">
        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="thumb_up">
        <path d="M1 21h4V9H1v12zm22-11c0-1.1-.9-2-2-2h-6.31l.95-4.57.03-.32c0-.41-.17-.79-.44-1.06L14.17 1 7.59 7.59C7.22 7.95 7 8.45 7 9v10c0 1.1.9 2 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73v-1.91l-.01-.01L23 10z"></path>
      </symbol>
    
      <symbol viewBox="0 0 24 24" id="today">
        <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"></path>
      </symbol>
    </svg>

    <div id="blog-post-container"></div>

 `;
export default class Posts extends HTMLElement {

    constructor() {
        super();
        this.posts = posts;
        this.shadow = this.attachShadow({mode: 'closed'});
        this.shadow.appendChild(template.content);
    }


    makePostItem = item => `
    <article class="blog-post">
        <div class="post-figure">
            <img src="${item.image}">
        </div>
        <div class="post-body">
            <h3 class="post-title">${item.name}</h3>
                <p class="meta">
                    By <span class="author">${item.author}</span> on <span class="date">${item.date}</span>
                </p>
                <p class="post-content">${item.content}</p>

                <div class="icon-actions">
                            <svg class="icon icon--inline">
                              <use xlink:href="#thumb_up"></use>
                            </svg>
                            <svg class="icon icon--inline">
                              <use xlink:href="#insert_emoticon"></use>
                            </svg>
                            <svg class="icon icon--inline">
                              <use xlink:href="#favorite"></use>
                            </svg>
                            <svg class="icon icon--inline">
                              <use xlink:href="#insert_comment"></use>
                            </svg>
                            <svg class="icon icon--inline">
                              <use xlink:href="#insert_link"></use>
                            </svg>
                            <svg class="icon icon--inline">
                              <use xlink:href="#share"></use>
                            </svg>
                </div>
                <a href="#" class="read-more">Read More</a>
            </div>
    </article>`;

    makeBlog = () => {
        let res = '';
        this.posts.forEach(item => {
            res += this.makePostItem(item);
        });
        return res;
    }

    connectedCallback() {
        const blogPostContainer = this.shadow.getElementById('blog-post-container');
        blogPostContainer.innerHTML = this.makeBlog();
    }
}