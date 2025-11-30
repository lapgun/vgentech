const ChatbotWidget = (() => {
    const storageKeys = {
        session: 'vgentech_chat_session',
        token: 'vgentech_chat_token',
    };

    const elements = {};
    const state = {
        sessionId: null,
        token: null,
        messagesLoaded: false,
        isSending: false,
    };

    function init() {
        elements.toggle = document.getElementById('chatbot-toggle');
        elements.widget = document.getElementById('chatbot-widget');
        elements.prechat = document.getElementById('chatbot-prechat');
        elements.conversation = document.getElementById('chatbot-conversation');
        elements.intakeForm = document.getElementById('chatbot-intake-form');
        elements.messageForm = document.getElementById('chatbot-message-form');
        elements.messages = document.getElementById('chatbot-messages');
        elements.typing = document.getElementById('chatbot-typing');
        elements.intakeAlert = document.getElementById('chatbot-intake-alert');
        elements.conversationAlert = document.getElementById('chatbot-conversation-alert');
        elements.messageInput = document.getElementById('chatbot-input');
        elements.close = document.getElementById('chatbot-close');

        if (!elements.toggle || !elements.widget) {
            return;
        }

        loadStoredSession();

        elements.toggle.addEventListener('click', toggleWidget);

        if (elements.close) {
            elements.close.addEventListener('click', closeWidget);
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeWidget();
            }
        });

        document.addEventListener('click', (event) => {
            if (!elements.widget || elements.widget.hidden) {
                return;
            }

            if (!elements.widget.contains(event.target) && !elements.toggle.contains(event.target)) {
                closeWidget();
            }
        });

        if (elements.intakeForm) {
            elements.intakeForm.addEventListener('submit', handleIntakeSubmit);
        }

        if (elements.messageForm) {
            elements.messageForm.addEventListener('submit', handleMessageSubmit);
        }
    }

    function toggleWidget() {
        if (!elements.widget) {
            return;
        }

        const isHidden = elements.widget.hasAttribute('hidden');

        if (isHidden) {
            openWidget();
        } else {
            closeWidget();
        }
    }

    function openWidget() {
        elements.widget.removeAttribute('hidden');
        elements.widget.setAttribute('aria-hidden', 'false');
        elements.toggle?.setAttribute('aria-expanded', 'true');

        if (state.sessionId && state.token) {
            showConversation();
            if (!state.messagesLoaded) {
                loadConversation();
            }
        } else {
            showPrechat();
        }
    }

    function closeWidget() {
        elements.widget.setAttribute('hidden', '');
        elements.widget.setAttribute('aria-hidden', 'true');
        elements.toggle?.setAttribute('aria-expanded', 'false');
    }

    function showPrechat() {
        if (!elements.prechat || !elements.conversation) {
            return;
        }
        elements.prechat.hidden = false;
        elements.conversation.hidden = true;
        // Remove chatting class for correct height
        elements.widget?.classList.remove('chatbot-widget--chatting');
    }

    function showConversation() {
        if (!elements.prechat || !elements.conversation) {
            return;
        }
        elements.prechat.hidden = true;
        elements.conversation.hidden = false;
        // Add chatting class for correct height
        elements.widget?.classList.add('chatbot-widget--chatting');
    }

    function loadStoredSession() {
        try {
            const savedSession = window.localStorage.getItem(storageKeys.session);
            const savedToken = window.localStorage.getItem(storageKeys.token);

            if (savedSession && savedToken) {
                state.sessionId = savedSession;
                state.token = savedToken;
            }
        } catch (error) {
            console.warn('ChatbotWidget: unable to access localStorage', error);
        }
    }

    function persistSession() {
        try {
            if (state.sessionId && state.token) {
                window.localStorage.setItem(storageKeys.session, state.sessionId);
                window.localStorage.setItem(storageKeys.token, state.token);
            }
        } catch (error) {
            console.warn('ChatbotWidget: unable to store session', error);
        }
    }

    function clearSession() {
        state.sessionId = null;
        state.token = null;
        state.messagesLoaded = false;

        try {
            window.localStorage.removeItem(storageKeys.session);
            window.localStorage.removeItem(storageKeys.token);
        } catch (error) {
            console.warn('ChatbotWidget: unable to clear stored session', error);
        }

        showPrechat();
    }

    async function handleIntakeSubmit(event) {
        event.preventDefault();

        if (!elements.intakeForm) {
            return;
        }

        hideAlert(elements.intakeAlert);

        const formData = new FormData(elements.intakeForm);
        const payload = {
            name: formData.get('name')?.toString().trim() ?? '',
            email: formData.get('email')?.toString().trim() || null,
            phone: formData.get('phone')?.toString().trim() || null,
            needs: formData.get('needs')?.toString().trim() || null,
        };

        if (!payload.name) {
            showAlert(elements.intakeAlert, 'error', t('nameRequired', 'Vui lòng nhập họ tên.'));
            return;
        }

        try {
            elements.intakeForm.classList.add('is-loading');
            const response = await fetch('/chatbot/session', {
                method: 'POST',
                headers: jsonHeaders(),
                body: JSON.stringify(payload),
            });

            const data = await parseJson(response);

            state.sessionId = data.session_id;
            state.token = data.token;
            state.messagesLoaded = true;
            persistSession();

            showConversation();
            replaceMessages(data.messages ?? []);
            elements.messageInput?.focus();
        } catch (error) {
            console.error('ChatbotWidget start error:', error);
            showAlert(elements.intakeAlert, 'error', error.message || t('genericError', 'Đã có lỗi xảy ra, vui lòng thử lại.'));
        } finally {
            elements.intakeForm.classList.remove('is-loading');
        }
    }

    async function loadConversation() {
        if (!state.sessionId || !state.token) {
            return;
        }

        try {
            const loadingText = t('loading', '');
            if (loadingText) {
                showAlert(elements.conversationAlert, 'info', loadingText);
            }
            const response = await fetch(`/chatbot/session/${encodeURIComponent(state.sessionId)}?token=${encodeURIComponent(state.token)}`, {
                headers: { Accept: 'application/json' },
            });

            const data = await parseJson(response);

            replaceMessages(data.messages ?? []);
            state.messagesLoaded = true;
            hideAlert(elements.conversationAlert);
        } catch (error) {
            console.error('ChatbotWidget load error:', error);
            if (error.name === 'UnauthorizedError') {
                clearSession();
                showAlert(elements.intakeAlert, 'error', error.message || t('sessionExpired', 'Phiên chat đã hết hạn.'));
                return;
            }

            showAlert(elements.conversationAlert, 'error', error.message || t('genericError', 'Không thể tải lịch sử chat.'));
        }
    }

    async function handleMessageSubmit(event) {
        event.preventDefault();

        if (!elements.messageInput || !state.sessionId || !state.token || state.isSending) {
            return;
        }

        const text = elements.messageInput.value.trim();

        if (!text) {
            return;
        }

        state.isSending = true;
        hideAlert(elements.conversationAlert);

        const pendingId = `temp-${Date.now()}`;
        const pendingMessage = {
            id: pendingId,
            sender: 'user',
            message: text,
            created_at: new Date().toISOString(),
        };

        appendMessage(pendingMessage);
        scrollMessagesToBottom();
        elements.messageInput.value = '';
        elements.messageInput.setAttribute('aria-busy', 'true');
        elements.typing?.removeAttribute('hidden');

        try {
            const response = await fetch(`/chatbot/session/${encodeURIComponent(state.sessionId)}/messages`, {
                method: 'POST',
                headers: jsonHeaders(),
                body: JSON.stringify({
                    token: state.token,
                    message: text,
                }),
            });

            const data = await parseJson(response);

            removePendingMessage(pendingId);
            (data.messages ?? []).forEach((message) => appendMessage(message));
            scrollMessagesToBottom();
        } catch (error) {
            console.error('ChatbotWidget send error:', error);
            removePendingMessage(pendingId);
            elements.messageInput.value = text;
            elements.messageInput.focus();
            showAlert(elements.conversationAlert, 'error', error.message || t('sendError', 'Không thể gửi tin nhắn.'));

            if (error.name === 'UnauthorizedError') {
                clearSession();
                showAlert(elements.intakeAlert, 'error', error.message || t('sessionExpired', 'Phiên chat đã hết hạn.'));
            }
        } finally {
            state.isSending = false;
            elements.messageInput.removeAttribute('aria-busy');
            elements.typing?.setAttribute('hidden', '');
        }
    }

    function replaceMessages(messages) {
        if (!elements.messages) {
            return;
        }

        elements.messages.innerHTML = '';

        if (!messages.length) {
            const empty = document.createElement('div');
            empty.className = 'chatbot-empty';
            empty.textContent = t('empty', 'Chưa có tin nhắn nào.');
            elements.messages.appendChild(empty);
            return;
        }

        messages.forEach((message) => appendMessage(message));
        scrollMessagesToBottom();
    }

    function appendMessage(message) {
        if (!elements.messages) {
            return null;
        }

        const existing = elements.messages.querySelector(`[data-message-id="${message.id}"]`);
        if (existing) {
            return existing;
        }

        if (elements.messages.firstElementChild?.classList.contains('chatbot-empty')) {
            elements.messages.innerHTML = '';
        }

        const wrapper = document.createElement('div');
        wrapper.className = `chatbot-message chatbot-message-${message.sender === 'bot' ? 'bot' : 'user'}`;
        wrapper.dataset.messageId = message.id;

        const bubble = document.createElement('div');
        bubble.className = 'chatbot-bubble';
        bubble.textContent = message.message;
        wrapper.appendChild(bubble);

        const meta = document.createElement('div');
        meta.className = 'chatbot-meta';
        meta.textContent = formatTimestamp(message.created_at);
        wrapper.appendChild(meta);

        elements.messages.appendChild(wrapper);
        return wrapper;
    }

    function removePendingMessage(id) {
        if (!elements.messages) {
            return;
        }

        const pending = elements.messages.querySelector(`[data-message-id="${id}"]`);
        pending?.remove();
    }

    function scrollMessagesToBottom() {
        if (!elements.messages) {
            return;
        }

        elements.messages.scrollTo({
            top: elements.messages.scrollHeight,
            behavior: 'smooth',
        });
    }

    function jsonHeaders() {
        return {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
        };
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';
    }

    async function parseJson(response) {
        let data = null;

        try {
            data = await response.clone().json();
        } catch (error) {
            // ignore parse errors for non JSON bodies
        }

        if (!response.ok) {
            let message = data?.message || t('genericError', 'Đã có lỗi xảy ra.');

            if (data?.errors) {
                const errors = Object.values(data.errors).flat().join(' ');
                if (errors) {
                    message = errors;
                }
            }

            if (response.status === 403) {
                const unauthorizedError = new Error(message || t('sessionExpired', 'Phiên chat không hợp lệ.'));
                unauthorizedError.name = 'UnauthorizedError';
                throw unauthorizedError;
            }

            throw new Error(message);
        }

        return data ?? {};
    }

    function showAlert(element, type, message) {
        if (!element || !message) {
            return;
        }

        element.textContent = message;
        element.classList.remove('success', 'error', 'info');
        const cssClass = type === 'error' ? 'error' : type === 'info' ? 'info' : 'success';
        element.classList.add(cssClass);
        element.style.display = 'block';
        element.removeAttribute('hidden');
    }

    function hideAlert(element) {
        if (!element) {
            return;
        }

        element.textContent = '';
        element.classList.remove('success', 'error', 'info');
        element.style.display = 'none';
        element.setAttribute('hidden', '');
    }

    function formatTimestamp(input) {
        if (!input) {
            return '';
        }

        try {
            const locale = document.documentElement.lang || navigator.language || 'vi-VN';
            return new Intl.DateTimeFormat(locale, {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            }).format(new Date(input));
        } catch (error) {
            return input;
        }
    }

    function t(key, fallback) {
        return window.__chatbotTranslations?.[key] ?? fallback;
    }

    return { init };
})();

document.addEventListener('DOMContentLoaded', () => {
    ChatbotWidget.init();
});
