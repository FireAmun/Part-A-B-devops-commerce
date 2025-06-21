<div id="chatbot-container">
    <!-- Floating Chat Button -->
    <div id="chat-toggle" class="chat-toggle">
        <div class="chat-toggle-avatar">
            <i class="fas fa-robot"></i>
        </div>
        <span class="chat-badge" id="chat-badge">1</span>
        <div class="chat-toggle-pulse"></div>
    </div>

    <!-- Chat Window -->
    <div id="chat-window" class="chat-window">
        <div class="chat-header">
            <div class="chat-header-info">
                <div class="bot-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="bot-info">
                    <h4>UTM Commerce Assistant</h4>
                    <div class="status-container">
                        <span class="status-dot"></span>
                        <span class="status">Online</span>
                    </div>
                </div>
            </div>
            <div class="chat-header-actions">
                <button class="chat-header-btn" id="clear-chat-btn" title="Clear conversation">
                    <i class="fas fa-eraser"></i>
                </button>
                <button class="chat-header-btn chat-close" id="close-chat-btn" title="Close chat">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="chat-messages" id="chat-messages">
            <div class="message bot-message">
                <div class="message-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="message-content">
                    <p>Hello! 👋 I'm your UTM Commerce Connect assistant. I can help you with:</p>
                    <ul>
                        <li>🏪 Information about our vendors</li>
                        <li>🛍️ Product inquiries</li>
                        <li>⏰ Opening hours & locations</li>
                        <li>📞 Contact information</li>
                        <li>❓ General questions</li>
                    </ul>
                    <p>How can I assist you today?</p>
                </div>
            </div>
        </div>

        <div class="chat-input-container">
            <div class="quick-questions" id="quick-questions">
                <button class="quick-btn" data-message="Tell me about UTM Mart">
                    <i class="fas fa-store"></i> UTM Mart
                </button>
                <button class="quick-btn" data-message="What does Richiamo Caffe offer?">
                    <i class="fas fa-coffee"></i> Richiamo Caffe
                </button>
                <button class="quick-btn" data-message="Setepak printing services?">
                    <i class="fas fa-print"></i> Printing
                </button>
                <button class="quick-btn" data-message="What products are trending?">
                    <i class="fas fa-chart-line"></i> Trending
                </button>
            </div>
            <div class="chat-input-area">
                <button id="chat-emoji-btn" class="emoji-btn" title="Add emoji">
                    <i class="far fa-smile"></i>
                </button>
                <input type="text" id="chat-input" placeholder="Type your message..." autocomplete="off">
                <button id="chat-voice-btn" class="voice-btn" title="Voice input">
                    <i class="fas fa-microphone"></i>
                </button>
                <button id="send-btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            <div id="emoji-picker" class="emoji-picker">
                <div class="emoji-categories">
                    <button class="emoji-category active" data-category="recent"><i class="fas fa-clock"></i></button>
                    <button class="emoji-category" data-category="smileys"><i class="fas fa-smile"></i></button>
                    <button class="emoji-category" data-category="objects"><i class="fas fa-coffee"></i></button>
                    <button class="emoji-category" data-category="symbols"><i class="fas fa-heart"></i></button>
                </div>
                <div class="emoji-container" id="emoji-container"></div>
            </div>
        </div>
    </div>
</div>

<style>
    #chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        font-family: 'Figtree', sans-serif;
    }

    /* Support for light/dark mode */
    #chatbot-container {
        --chat-primary: #2563eb;
        --chat-primary-light: #3b82f6;
        --chat-primary-dark: #1e40af;
        --chat-accent: #8b5cf6;
        --chat-bg: #ffffff;
        --chat-text: #1f2937;
        --chat-text-light: #6b7280;
        --chat-border: #e5e7eb;
        --chat-user-bubble: #f3f4f6;
        --chat-bot-bubble: #ede9fe;
        --chat-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    body.dark-mode #chatbot-container {
        --chat-primary: #3b82f6;
        --chat-primary-light: #60a5fa;
        --chat-primary-dark: #2563eb;
        --chat-accent: #a78bfa;
        --chat-bg: #1e1e2d;
        --chat-text: #f9fafb;
        --chat-text-light: #d1d5db;
        --chat-border: #374151;
        --chat-user-bubble: #374151;
        --chat-bot-bubble: #4c1d95;
        --chat-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
    }

    .chat-toggle {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, var(--chat-primary) 0%, var(--chat-accent) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
        transition: all 0.3s ease;
        position: relative;
    }

    .chat-toggle:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 25px rgba(102, 126, 234, 0.6);
    }

    .chat-toggle-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .chat-toggle:hover .chat-toggle-avatar {
        transform: rotate(15deg);
    }

    .chat-toggle i {
        color: white;
        font-size: 24px;
    }

    .chat-toggle-pulse {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 2px solid white;
        opacity: 0;
        animation: pulse-wave 2s infinite;
    }

    @keyframes pulse-wave {
        0% {
            transform: scale(0.8);
            opacity: 0.8;
        }
        70% {
            transform: scale(1.5);
            opacity: 0;
        }
        100% {
            transform: scale(0.8);
            opacity: 0;
        }
    }

    .chat-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #ef4444;
        color: white;
        border-radius: 12px;
        min-width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        padding: 0 6px;
        box-shadow: 0 3px 6px rgba(239, 68, 68, 0.3);
        border: 2px solid white;
        animation: badge-bounce 2s infinite;
    }

    @keyframes badge-bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-5px);
        }
        60% {
            transform: translateY(-2px);
        }
    }

    .chat-window {
        position: absolute;
        bottom: 80px;
        right: 0;
        width: 380px;
        height: 520px;
        background: var(--chat-bg);
        border-radius: 20px;
        box-shadow: var(--chat-shadow);
        display: none;
        flex-direction: column;
        overflow: hidden;
        transform: translateY(20px) scale(0.95);
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid var(--chat-border);
    }

    .chat-window.show {
        display: flex;
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    .chat-header {
        background: linear-gradient(135deg, var(--chat-primary) 0%, var(--chat-accent) 100%);
        color: white;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .chat-header-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .chat-header-btn {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .chat-header-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: scale(1.1);
    }

    .chat-header-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .bot-avatar {
        width: 42px;
        height: 42px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .bot-avatar:before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, transparent 40%, rgba(255, 255, 255, 0.4) 50%, transparent 60%);
        transform: translateX(-100%);
        animation: avatar-shine 3s infinite;
    }

    @keyframes avatar-shine {
        0% { transform: translateX(-100%); }
        50%, 100% { transform: translateX(100%); }
    }

    .bot-avatar i {
        font-size: 20px;
    }

    .bot-info h4 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .status-container {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-top: 2px;
    }

    .status {
        font-size: 0.8rem;
        opacity: 0.9;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background: #22c55e;
        border-radius: 50%;
        position: relative;
        display: inline-block;
    }

    .status-dot:after {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        width: 12px;
        height: 12px;
        background: transparent;
        border-radius: 50%;
        border: 1px solid #22c55e;
        opacity: 0.6;
        animation: status-pulse 2s infinite;
    }

    @keyframes status-pulse {
        0% { transform: scale(0.8); opacity: 0.8; }
        70% { transform: scale(1.2); opacity: 0; }
        100% { transform: scale(0.8); opacity: 0; }
    }

    .chat-close {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 4px;
        transition: background 0.2s;
    }

    .chat-close:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .chat-messages {
        flex: 1;
        padding: 1rem;
        overflow-y: auto;
        background: #f8fafc;
    }

    .message {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1rem;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .bot-message .message-avatar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .user-message {
        flex-direction: row-reverse;
    }

    .user-message .message-avatar {
        background: #e5e7eb;
        color: #6b7280;
    }

    .message-content {
        background: white;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        max-width: 70%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .user-message .message-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .message-content p {
        margin: 0 0 0.5rem 0;
        line-height: 1.4;
    }

    .message-content p:last-child {
        margin-bottom: 0;
    }

    .message-content ul {
        margin: 0.5rem 0;
        padding-left: 1.25rem;
    }

    .message-content li {
        margin-bottom: 0.25rem;
        line-height: 1.4;
    }

    .chat-input-container {
        padding: 1rem;
        background: var(--chat-bg);
        border-top: 1px solid var(--chat-border);
        position: relative;
    }

    .quick-questions {
        display: flex;
        gap: 0.6rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        transition: all 0.3s ease;
    }

    .quick-btn {
        background: rgba(102, 126, 234, 0.1);
        border: 1px solid rgba(102, 126, 234, 0.3);
        border-radius: 20px;
        padding: 0.5rem 0.9rem;
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--chat-primary);
    }

    .quick-btn:hover {
        background: var(--chat-primary);
        color: white;
        border-color: var(--chat-primary);
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(102, 126, 234, 0.3);
    }

    .quick-btn i {
        font-size: 0.9rem;
    }

    .chat-input-area {
        display: flex;
        gap: 0.6rem;
        align-items: center;
        position: relative;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 25px;
        padding: 0.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--chat-border);
    }

    .emoji-btn, .voice-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
        background: transparent;
        color: var(--chat-text-light);
        transition: all 0.2s;
        font-size: 1.1rem;
    }

    .emoji-btn:hover, .voice-btn:hover {
        background: rgba(102, 126, 234, 0.1);
        color: var(--chat-primary);
    }

    #chat-input {
        flex: 1;
        padding: 0.75rem 0.5rem;
        border: none;
        background: transparent;
        outline: none;
        color: var(--chat-text);
        font-size: 0.95rem;
    }

    #chat-input::placeholder {
        color: var(--chat-text-light);
        opacity: 0.7;
    }

    #send-btn {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--chat-primary) 0%, var(--chat-accent) 100%);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
    }

    #send-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.6);
    }

    .emoji-picker {
        position: absolute;
        bottom: 60px;
        left: 0;
        width: 100%;
        background: var(--chat-bg);
        border-radius: 12px;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        padding: 0.75rem;
        display: none;
        z-index: 10;
        border: 1px solid var(--chat-border);
    }

    .emoji-categories {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--chat-border);
    }

    .emoji-category {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: transparent;
        cursor: pointer;
    }

    .emoji-category.active {
        background: rgba(102, 126, 234, 0.1);
        color: var(--chat-primary);
    }

    .emoji-container {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 0.5rem;
    }

    .typing-indicator {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .typing-dots {
        background: white;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .typing-dots span {
        display: inline-block;
        width: 6px;
        height: 6px;
        background: #9ca3af;
        border-radius: 50%;
        margin: 0 2px;
        animation: typing 1.5s infinite;
    }

    .typing-dots span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-dots span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing {
        0%, 60%, 100% {
            transform: translateY(0);
            opacity: 0.3;
        }
        30% {
            transform: translateY(-10px);
            opacity: 1;
        }
    }

    /* Emoji picker and voice input styles */
    .emoji-item {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        background: transparent;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .emoji-item:hover {
        background: rgba(102, 126, 234, 0.1);
        transform: scale(1.1);
    }

    .voice-btn.listening {
        background: var(--chat-primary-light);
        color: white;
        animation: pulse-recording 1.5s infinite;
    }

    @keyframes pulse-recording {
        0% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.5);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
        }
    }

    /* Improved accessibility styles */
    @media (prefers-reduced-motion: reduce) {
        .chat-toggle-pulse,
        .status-dot:after,
        .badge-bounce,
        .avatar-shine,
        .pulse-recording {
            animation: none !important;
        }
    }

    @media (max-width: 480px) {
        .chat-window {
            width: calc(100vw - 40px);
            height: 70vh;
            bottom: 70px;
        }

        .quick-questions {
            overflow-x: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
            padding-bottom: 5px;
        }

        .quick-questions::-webkit-scrollbar {
            display: none;
        }
    }
</style>

<script>
    let chatOpen = false;
    let conversationContext = {
        userName: null,
        lastInteraction: null,
        mood: 'neutral',
        preferredVendor: null,
        chatHistory: []
    };

    // Enhanced chatbot intelligence system
    class ChatbotAI {
        constructor() {
            this.personality = {
                name: 'Maya',
                role: 'UTM Commerce Connect Assistant',
                traits: ['friendly', 'helpful', 'knowledgeable', 'enthusiastic'],
                greetings: [
                    "Hello there! 👋 I'm Maya, your friendly UTM Commerce Connect assistant!",
                    "Hi! 😊 Great to meet you! I'm Maya, and I'm here to help you with anything related to our campus vendors.",
                    "Hey! 🌟 I'm Maya, your personal shopping assistant for UTM Commerce Connect!",
                    "Hello! ✨ Maya here! I'm excited to help you discover amazing products and services on campus!"
                ],
                responses: {
                    positive: ["That's wonderful!", "I'm so glad to hear that!", "That sounds great!", "Awesome!"],
                    negative: ["I'm sorry to hear that.", "Let me help you with that.", "I understand how frustrating that can be."],
                    thanks: ["You're very welcome! 😊", "Happy to help!", "My pleasure!", "Anytime! That's what I'm here for!"],
                    compliments: ["Thank you so much! That really makes my day! 😊", "You're too kind! I try my best to help!", "Aww, thank you! I love helping our UTM community!"]
                }
            };

            this.vendorData = {
                'utm_mart': {
                    name: 'UTM Mart',
                    keywords: ['utm', 'mart', 'university', 'campus', 'shirt', 'cup', 'book', 'merchandise', 'student', 'stationery'],
                    location: 'UTM Campus',
                    hours: 'Mon-Thu: 8:30 AM – 1 PM, 2 PM – 4:45 PM; Fri: 8:30 AM – 12:15 PM, 2:30 PM – 4:45 PM',
                    email: 'utmart@utm.my',
                    phone: '+60149321546',
                    products: ['UTM Shirt (RM25)', 'UTM Cup (RM15)', 'Books (RM40)', 'Stationery', 'Campus essentials'],
                    specialty: 'University merchandise and student essentials',
                    personality: 'Your go-to place for all things UTM! Perfect for showing your university pride.'
                },
                'richiamo_caffe': {
                    name: 'Richiamo Caffe',
                    keywords: ['richiamo', 'caffe', 'coffee', 'espresso', 'latte', 'cappuccino', 'drink', 'beverage', 'food', 'nasi', 'meal', 'cafe'],
                    location: 'UTM Campus',
                    hours: 'Daily: 8:00 AM - 6:00 PM',
                    email: 'richiamocaffe@gmail.com',
                    phone: 'Contact via email',
                    products: ['Hot Beverages (RM5.40-14.20)', 'Cold Beverages (RM10.70-14.20)', 'Smoothies (RM8.00)', 'Local Food (RM6.70-26.90)'],
                    specialty: 'Premium coffee and authentic local cuisine',
                    personality: 'The perfect spot for coffee lovers and food enthusiasts! Great for study sessions or catching up with friends.'
                },
                'setepak_printing': {
                    name: 'Setepak Printing Service KTF',
                    keywords: ['setepak', 'printing', 'print', 'business', 'card', 'banner', 'sticker', 'flyer', 'brochure', 'photocopy', 'thesis'],
                    location: 'Near UTM Campus',
                    hours: 'Mon-Fri: 9:00 AM - 6:00 PM',
                    email: 'setepakprintingservicektf@gmail.com',
                    phone: 'Contact via email',
                    products: ['Business Cards', 'Banners', 'Stickers', 'Flyers', 'Brochures', 'Photocopying', 'T-shirt Printing', 'Thesis Printing'],
                    specialty: 'Professional printing services for academic and business needs',
                    personality: 'Your academic printing partner! From thesis to business cards, they\'ve got you covered.'
                }
            };

            this.intentPatterns = {
                greeting: /\b(hi|hello|hey|good morning|good afternoon|good evening|greetings|hola|sup|yo)\b/i,
                identity: /\b(who are you|what are you|your name|tell me about yourself|introduce yourself)\b/i,
                wellbeing: /\b(how are you|how are you doing|how's it going|what's up|how have you been)\b/i,
                thanks: /\b(thank you|thanks|appreciate|grateful)\b/i,
                compliment: /\b(good job|well done|amazing|awesome|great|excellent|perfect|you're great|love you|you're the best)\b/i,
                suggestion: /\b(suggest|recommend|what should i|advice|help me choose|what do you think|opinion)\b/i,
                hours: /\b(hours?|time|open|close|when|schedule|operating)\b/i,
                location: /\b(where|location|address|find|direction)\b/i,
                contact: /\b(contact|phone|email|call|reach|number)\b/i,
                pricing: /\b(price|cost|how much|expensive|cheap|rate|fee|budget|afford)\b/i,
                products: /\b(product|item|sell|buy|available|menu|offer|service|shop|shopping)\b/i,
                help: /\b(help|assist|support|guide|how|can you|confused|lost|don't know)\b/i,
                ordering: /\b(order|purchase|buy|checkout|cart|payment|pay)\b/i,
                comparison: /\b(compare|difference|better|vs|versus|which|between)\b/i,
                mood_positive: /\b(happy|excited|great|wonderful|amazing|love|perfect|fantastic)\b/i,
                mood_negative: /\b(sad|disappointed|frustrated|angry|bad|terrible|awful|hate|problem|issue)\b/i,
                casual: /\b(what's happening|how's life|what's new|tell me something|chat|talk|bored)\b/i,
                goodbye: /\b(bye|goodbye|see you|talk later|later|farewell|take care)\b/i
            };

            this.contextualResponses = {
                first_visit: "Since this is our first chat, let me tell you that UTM Commerce Connect brings together three amazing vendors right here on campus!",
                returning_user: "Great to see you back! How can I help you today?",
                frequent_user: "Welcome back, my friend! You're becoming quite the regular here! 😊"
            };
        }

        analyzeMessage(message) {
            const analysis = {
                message: message.toLowerCase().trim(),
                originalMessage: message,
                vendors: [],
                intent: null,
                mood: 'neutral',
                entities: {},
                confidence: 0,
                isQuestion: message.includes('?'),
                hasEmoji: /[\u{1F600}-\u{1F64F}]|[\u{1F300}-\u{1F5FF}]|[\u{1F680}-\u{1F6FF}]|[\u{1F1E0}-\u{1F1FF}]/u.test(message),
                wordCount: message.split(' ').length,
                isShort: message.split(' ').length <= 3
            };

            // Detect mentioned vendors
            for (const [vendorKey, vendorData] of Object.entries(this.vendorData)) {
                for (const keyword of vendorData.keywords) {
                    if (analysis.message.includes(keyword.toLowerCase())) {
                        analysis.vendors.push(vendorKey);
                        analysis.confidence += 0.1;
                        break;
                    }
                }
            }

            // Detect intent with higher accuracy
            let maxConfidence = 0;
            for (const [intent, pattern] of Object.entries(this.intentPatterns)) {
                if (pattern.test(analysis.message)) {
                    if (intent === 'greeting' && analysis.isShort) {
                        analysis.confidence += 0.4;
                    } else {
                        analysis.confidence += 0.3;
                    }

                    if (analysis.confidence > maxConfidence) {
                        maxConfidence = analysis.confidence;
                        analysis.intent = intent;
                    }
                }
            }

            // Analyze mood and sentiment
            if (this.intentPatterns.mood_positive.test(analysis.message)) {
                analysis.mood = 'positive';
            } else if (this.intentPatterns.mood_negative.test(analysis.message)) {
                analysis.mood = 'negative';
            }

            // Extract personal context
            const nameMatch = analysis.message.match(/my name is (\w+)|i'm (\w+)|call me (\w+)/i);
            if (nameMatch) {
                analysis.entities.name = nameMatch[1] || nameMatch[2] || nameMatch[3];
            }

            // Detect time references
            const timeMatch = analysis.message.match(/(\d{1,2}):?(\d{2})?\s*(am|pm)|morning|afternoon|evening|night/i);
            if (timeMatch) {
                analysis.entities.timeContext = timeMatch[0];
            }

            return analysis;
        }

        generateResponse(analysis) {
            // Update conversation context
            conversationContext.lastInteraction = new Date();
            conversationContext.mood = analysis.mood;
            conversationContext.chatHistory.push(analysis.originalMessage);

            if (analysis.entities.name && !conversationContext.userName) {
                conversationContext.userName = analysis.entities.name;
            }

            const { vendors, intent, mood, entities, isShort } = analysis;

            // Handle different intents with personality
            switch (intent) {
                case 'greeting':
                    return this.handleGreeting(analysis);
                case 'identity':
                    return this.handleIdentity(analysis);
                case 'wellbeing':
                    return this.handleWellbeing(analysis);
                case 'thanks':
                    return this.handleThanks(analysis);
                case 'compliment':
                    return this.handleCompliment(analysis);
                case 'suggestion':
                    return this.handleSuggestion(analysis);
                case 'goodbye':
                    return this.handleGoodbye(analysis);
                case 'casual':
                    return this.handleCasualChat(analysis);
                case 'help':
                    return this.handleHelp(analysis);
                default:
                    // Handle vendor-specific or general queries
                    if (vendors.length > 0) {
                        return this.handleVendorQuery(vendors, intent, analysis);
                    }
                    return this.handleGeneralQuery(analysis);
            }
        }

        handleGreeting(analysis) {
            const hour = new Date().getHours();
            let timeGreeting = '';

            if (hour < 12) timeGreeting = 'Good morning';
            else if (hour < 17) timeGreeting = 'Good afternoon';
            else timeGreeting = 'Good evening';

            const personalGreeting = conversationContext.userName
                ? `${timeGreeting}, ${conversationContext.userName}! `
                : `${timeGreeting}! `;

            const mainGreeting = this.personality.greetings[Math.floor(Math.random() * this.personality.greetings.length)];

            return `${personalGreeting}${mainGreeting}<br><br>
                I'm here to help you discover amazing products and services from our three fantastic campus vendors:<br>
                🏪 <strong>UTM Mart</strong> - ${this.vendorData.utm_mart.personality}<br>
                ☕ <strong>Richiamo Caffe</strong> - ${this.vendorData.richiamo_caffe.personality}<br>
                🖨️ <strong>Setepak Printing</strong> - ${this.vendorData.setepak_printing.personality}<br><br>
                What can I help you explore today? 😊`;
        }

        handleIdentity(analysis) {
            return `Hi there! I'm <strong>${this.personality.name}</strong>, your friendly ${this.personality.role}! 🤖✨<br><br>
                I'm here to make your campus shopping experience amazing! I know everything about our three wonderful vendors and I love helping students, faculty, and staff find exactly what they need.<br><br>
                Think of me as your personal shopping buddy who's available 24/7! I can help you with:<br>
                💡 Product recommendations<br>
                🕒 Vendor hours and availability<br>
                💰 Pricing information<br>
                📍 Locations and contact details<br>
                🛒 How to place orders<br><br>
                I'm always learning and getting better at helping our UTM community! What would you like to know? 😊`;
        }

        handleWellbeing(analysis) {
            const responses = [
                "I'm doing fantastic, thank you for asking! 😊 Helping people like you always makes my day brighter!",
                "I'm wonderful! Every conversation I have makes me better at helping our UTM community! How are you doing?",
                "I'm great! I love chatting with students and helping them discover amazing products and services! How's your day going?",
                "I'm doing amazing! Nothing makes me happier than helping people find what they need on campus! How are you feeling today?"
            ];

            const response = responses[Math.floor(Math.random() * responses.length)];

            if (analysis.mood === 'positive') {
                return `${response}<br><br>You seem to be in a great mood! That's wonderful! Is there anything special you're looking for today? Maybe something to celebrate with? ☕🎉`;
            } else if (analysis.mood === 'negative') {
                return `${response}<br><br>I hope I can help brighten your day! Sometimes a good cup of coffee from Richiamo Caffe or finding that perfect item you need can really help! What can I do for you? 💪`;
            }

            return `${response}<br><br>What brings you to UTM Commerce Connect today? I'm excited to help! 🌟`;
        }

        handleThanks(analysis) {
            const response = this.personality.responses.thanks[Math.floor(Math.random() * this.personality.responses.thanks.length)];
            return `${response}<br><br>Is there anything else I can help you with? I'm always here to make your campus shopping experience better! 🌟`;
        }

        handleCompliment(analysis) {
            const response = this.personality.responses.compliments[Math.floor(Math.random() * this.personality.responses.compliments.length)];
            return `${response}<br><br>Your kind words really motivate me to keep helping our amazing UTM community! What can I assist you with today? ✨`;
        }

        handleSuggestion(analysis) {
            const hour = new Date().getHours();
            const day = new Date().getDay(); // 0 = Sunday, 1 = Monday, etc.

            let suggestions = "🌟 <strong>Here are my personalized suggestions for you:</strong><br><br>";

            // Time-based suggestions
            if (hour >= 7 && hour <= 10) {
                suggestions += "🌅 <strong>Perfect Morning Picks:</strong><br>";
                suggestions += "☕ Start your day with Richiamo Caffe's energizing espresso or cappuccino<br>";
                suggestions += "📚 Grab any study materials you need from UTM Mart<br>";
                suggestions += "🖨️ Get your printing done early at Setepak - less crowded in the morning!<br><br>";
            } else if (hour >= 11 && hour <= 14) {
                suggestions += "🌞 <strong>Midday Recommendations:</strong><br>";
                suggestions += "🍽️ Try Richiamo Caffe's delicious Nasi Lemak or pasta dishes<br>";
                suggestions += "☕ Perfect time for an iced coffee or smoothie to beat the heat<br>";
                suggestions += "📋 Handle any printing needs while vendors are fully operational<br><br>";
            } else if (hour >= 15 && hour <= 18) {
                suggestions += "🌆 <strong>Afternoon Suggestions:</strong><br>";
                suggestions += "☕ Unwind with Richiamo's afternoon coffee specials<br>";
                suggestions += "🛍️ Browse UTM Mart for any essentials you might need<br>";
                suggestions += "📄 Last chance for printing services before they close<br><br>";
            } else {
                suggestions += "🌙 <strong>Evening Planning:</strong><br>";
                suggestions += "📝 Plan tomorrow's needs - maybe some printing or study materials?<br>";
                suggestions += "☕ Note down your coffee preferences for tomorrow's Richiamo visit<br>";
                suggestions += "🛒 Add items to your wishlist for tomorrow's shopping<br><br>";
            }

            // Day-based suggestions
            if (day === 1) { // Monday
                suggestions += "💪 <strong>Monday Motivation:</strong><br>";
                suggestions += "Start your week strong with UTM gear to show your university pride!<br><br>";
            } else if (day === 5) { // Friday
                suggestions += "🎉 <strong>Friday Vibes:</strong><br>";
                suggestions += "Celebrate the end of the week with something special from Richiamo Caffe!<br><br>";
            }

            // Context-based suggestions
            if (analysis.message.includes('study') || analysis.message.includes('exam')) {
                suggestions += "📖 <strong>Study Session Essentials:</strong><br>";
                suggestions += "• Coffee from Richiamo to keep you energized<br>";
                suggestions += "• Stationery from UTM Mart for note-taking<br>";
                suggestions += "• Printing services for study materials<br><br>";
            }

            suggestions += "What type of products or services are you most interested in? I can give you more specific recommendations! 😊";

            return suggestions;
        }

        handleGoodbye(analysis) {
            const farewells = [
                "Goodbye! 👋 Thanks for chatting with me today! Come back anytime you need help!",
                "See you later! 😊 It was great helping you today! Have an amazing time on campus!",
                "Take care! ✨ Remember, I'm always here whenever you need assistance with our vendors!",
                "Bye for now! 🌟 Hope you find everything you're looking for! Don't hesitate to chat again!"
            ];

            const farewell = farewells[Math.floor(Math.random() * farewells.length)];

            if (conversationContext.userName) {
                return farewell.replace('Goodbye!', `Goodbye, ${conversationContext.userName}!`);
            }

            return farewell;
        }

        handleCasualChat(analysis) {
            const casualResponses = [
                "You know what's exciting? Our campus has such amazing vendors! Each one has its own unique personality and amazing offerings! What's your favorite spot so far?",
                "Life on campus is pretty great with all these convenient services! Have you tried exploring all three of our vendors yet?",
                "Things are always buzzing here at UTM Commerce Connect! Students are discovering new favorites every day. What kind of things do you usually look for?",
                "I love hearing about what's happening around campus! Are you working on any projects that might need our printing services? Or maybe you need a coffee break? ☕"
            ];

            return casualResponses[Math.floor(Math.random() * casualResponses.length)];
        }

        handleHelp(analysis) {
            return `Of course! I'm here to help! 🤗<br><br>
                <strong>Here's how I can assist you:</strong><br><br>

                🗣️ <strong>Just talk to me naturally!</strong> I understand conversational language, so feel free to ask questions like:<br>
                • "What's good for breakfast?"<br>
                • "Where can I print my thesis?"<br>
                • "I need something for under RM20"<br>
                • "What's open right now?"<br><br>

                🎯 <strong>I can help you with:</strong><br>
                • Finding products and services<br>
                • Comparing vendors and prices<br>
                • Checking operating hours<br>
                • Getting contact information<br>
                • Understanding the ordering process<br>
                • Personal recommendations<br><br>

                💬 Don't worry about using perfect keywords - I'm smart enough to understand what you mean! What would you like help with today?`;
        }

        handleVendorQuery(vendors, intent, analysis) {
            const vendor = vendors[0];
            const vendorData = this.vendorData[vendor];

            let response = `✨ <strong>${vendorData.name}</strong><br><br>`;
            response += `${vendorData.personality}<br><br>`;

            // Add specific information based on what they're asking
            if (intent === 'hours' || analysis.message.includes('time') || analysis.message.includes('open')) {
                response += `⏰ <strong>Hours:</strong> ${vendorData.hours}<br>`;
                response += this.getVendorStatusMessage(vendor);
            } else if (intent === 'contact' || analysis.message.includes('contact') || analysis.message.includes('phone')) {
                response += `📞 <strong>Contact Info:</strong><br>`;
                response += `📧 ${vendorData.email}<br>`;
                if (vendorData.phone !== 'Contact via email') {
                    response += `📱 ${vendorData.phone}<br>`;
                }
            } else if (intent === 'pricing' || analysis.message.includes('price') || analysis.message.includes('cost')) {
                response += `💰 <strong>What they offer:</strong><br>`;
                vendorData.products.forEach(product => {
                    response += `• ${product}<br>`;
                });
            } else {
                // General vendor info
                response += `📍 <strong>Location:</strong> ${vendorData.location}<br>`;
                response += `⏰ <strong>Hours:</strong> ${vendorData.hours}<br>`;
                response += `📧 <strong>Email:</strong> ${vendorData.email}<br><br>`;
                response += `🛍️ <strong>Specializes in:</strong> ${vendorData.specialty}`;
            }

            response += this.getContextualSuggestions(vendor, intent, analysis);
            return response;
        }

        getVendorStatusMessage(vendor) {
            const hour = new Date().getHours();
            const day = new Date().getDay();
            const isOpen = this.isVendorCurrentlyOpen(vendor, hour, day);

            if (isOpen) {
                return `<br>🟢 <strong>Currently OPEN!</strong> Perfect timing! 🎉<br>`;
            } else {
                return `<br>🔴 <strong>Currently closed</strong> - but you can plan your visit for tomorrow! 📅<br>`;
            }
        }

        isVendorCurrentlyOpen(vendor, hour, day) {
            const schedules = {
                'utm_mart': {
                    weekdays: [[8, 13], [14, 17]],
                    friday: [[8, 12], [14, 17]]
                },
                'richiamo_caffe': {
                    daily: [[8, 18]]
                },
                'setepak_printing': {
                    weekdays: [[9, 18]]
                }
            };

            const schedule = schedules[vendor];
            if (!schedule) return false;

            if (vendor === 'utm_mart') {
                const periods = day === 5 ? schedule.friday : schedule.weekdays;
                return periods.some(([start, end]) => hour >= start && hour < end);
            } else if (vendor === 'richiamo_caffe') {
                const [start, end] = schedule.daily[0];
                return hour >= start && hour < end;
            } else if (vendor === 'setepak_printing') {
                if (day === 0 || day === 6) return false; // Weekends
                const [start, end] = schedule.weekdays[0];
                return hour >= start && hour < end;
            }

            return false;
        }

        getContextualSuggestions(vendor, intent, analysis) {
            const suggestions = {
                'utm_mart': [
                    '<br><br>💡 <em>Maya\'s tip: Their UTM shirts are super popular among students - great for showing university pride!</em>',
                    '<br><br>🎓 <em>Perfect for: Getting campus essentials, university merchandise, and study materials!</em>',
                    '<br><br>📚 <em>Pro tip: They have a good selection of academic books and stationery!</em>'
                ],
                'richiamo_caffe': [
                    '<br><br>☕ <em>Maya\'s favorite: Their iced coffee varieties are perfect for hot days!</em>',
                    '<br><br>🍽️ <em>Don\'t miss: Their Nasi Lemak varieties are authentic and delicious!</em>',
                    '<br><br>📖 <em>Study tip: Great spot for coffee breaks during long study sessions!</em>'
                ],
                'setepak_printing': [
                    '<br><br>📋 <em>Maya\'s advice: Book early for thesis printing during submission periods!</em>',
                    '<br><br>💼 <em>Business ready: They do professional business cards and promotional materials!</em>',
                    '<br><br>🎯 <em>Academic focus: Perfect for all your printing needs from assignments to final projects!</em>'
                ]
            };

            const vendorSuggestions = suggestions[vendor] || [''];
            return vendorSuggestions[Math.floor(Math.random() * vendorSuggestions.length)];
        }

        handleGeneralQuery(analysis) {
            if (analysis.mood === 'negative') {
                return `I can sense you might be frustrated. Let me help make things easier! 🤗<br><br>
                    I'm here to simplify your campus shopping experience. Whether you need:<br>
                    • ☕ A good coffee to improve your mood<br>
                    • 🛍️ Some retail therapy at UTM Mart<br>
                    • 📋 Help with printing projects<br><br>
                    Just tell me what's on your mind, and I'll guide you to the perfect solution! What's bothering you?`;
            }

            const generalResponses = [
                `I'd love to help you! 😊 I'm like your personal campus concierge - I know all about our three amazing vendors and can help you find exactly what you need.<br><br>Try asking me things like:<br>• "What's good for lunch?"<br>• "I need something under RM15"<br>• "Where can I get coffee?"<br>• "Help me find printing services"<br><br>What are you looking for today?`,

                `Hey there! I'm designed to make your campus life easier! 🌟<br><br>I can help you discover amazing products, compare prices, check what's open, and even give you personalized recommendations based on your needs and budget.<br><br>What kind of help are you looking for today?`,

                `I'm here to be your helpful campus companion! 🤖💙<br><br>Whether you're a student rushing between classes, faculty looking for convenience, or staff needing specific services - I've got you covered!<br><br>What can I help you explore today?`
            ];

            return generalResponses[Math.floor(Math.random() * generalResponses.length)];
        }
    }

    const chatbotAI = new ChatbotAI();

    function toggleChat() {
        const chatWindow = document.getElementById('chat-window');
        const chatBadge = document.getElementById('chat-badge');

        if (chatOpen) {
            chatWindow.classList.remove('show');
            chatOpen = false;
        } else {
            chatWindow.classList.add('show');
            chatOpen = true;
            chatBadge.style.display = 'none';
            document.getElementById('chat-input').focus();

            // Save that user has opened the chat before
            localStorage.setItem('utm_chat_opened', 'true');
        }
    }

    function sendQuickMessage(message) {
        document.getElementById('chat-input').value = message;
        sendMessage();
    }

    function sendMessage() {
        const input = document.getElementById('chat-input');
        const message = input.value.trim();

        if (!message) return;

        // Add user message to chat
        addMessage(message, 'user');
        input.value = '';

        // Save to chat history
        saveToHistory('user', message);

        // Show typing indicator
        showTypingIndicator();

        // Process message with enhanced AI
        setTimeout(() => {
            hideTypingIndicator();

            // Analyze user input with enhanced intelligence
            const analysis = chatbotAI.analyzeMessage(message);

            // Update conversation context
            conversationContext.lastQuery = analysis;
            conversationContext.messageCount = (conversationContext.messageCount || 0) + 1;
            conversationContext.timestamp = new Date();

            // Check if first conversation or returning user
            if (conversationContext.messageCount === 1 && localStorage.getItem('utm_chat_opened')) {
                conversationContext.returningUser = true;
            }

            // Generate intelligent response with personalization
            const response = chatbotAI.generateResponse(analysis);

            addMessage(response, 'bot');
            saveToHistory('bot', response);

            // Update suggestions based on conversation
            updateSuggestions(analysis);

            // Send analytics data (would connect to backend in production)
            if (typeof sendChatAnalytics === 'function') {
                sendChatAnalytics({
                    userMessage: message,
                    botResponse: response,
                    intent: analysis.intent,
                    sentiment: analysis.mood,
                    sessionLength: conversationContext.messageCount
                });
            }

        }, 800 + Math.random() * 1200); // Realistic AI processing time
    }

    // Save chat history to localStorage
    function saveToHistory(sender, message) {
        try {
            const history = JSON.parse(localStorage.getItem('utm_chat_history') || '[]');
            history.push({
                sender,
                message,
                timestamp: new Date().toISOString()
            });

            // Keep only last 50 messages
            if (history.length > 50) {
                history.shift();
            }

            localStorage.setItem('utm_chat_history', JSON.stringify(history));
        } catch (e) {
            console.error('Error saving chat history:', e);
        }
    }

    // Update quick suggestion buttons based on conversation context
    function updateSuggestions(analysis) {
        const quickQuestions = document.getElementById('quick-questions');

        // Don't update too frequently
        if (conversationContext.lastSuggestionUpdate &&
            (new Date() - conversationContext.lastSuggestionUpdate) < 10000) {
            return;
        }

        // Personalized suggestions based on context
        let suggestions = [];

        if (analysis.vendors.includes('utm_mart')) {
            suggestions.push({
                text: 'UTM Mart hours?',
                icon: 'fa-clock'
            });
        } else if (analysis.vendors.includes('richiamo_caffe')) {
            suggestions.push({
                text: 'Richiamo menu?',
                icon: 'fa-utensils'
            });
        } else if (analysis.vendors.includes('setepak_printing')) {
            suggestions.push({
                text: 'Printing prices?',
                icon: 'fa-tag'
            });
        }

        // Add contextual suggestions
        if (analysis.intent === 'product_inquiry') {
            suggestions.push({
                text: 'Compare vendors',
                icon: 'fa-balance-scale'
            });
        } else if (analysis.intent === 'pricing') {
            suggestions.push({
                text: 'Student discounts',
                icon: 'fa-graduation-cap'
            });
        } else if (analysis.mood === 'positive') {
            suggestions.push({
                text: 'Special offers',
                icon: 'fa-gift'
            });
        }

        // Always add a help option
        suggestions.push({
            text: 'Help me find...',
            icon: 'fa-search'
        });

        // Update the UI if we have new suggestions
        if (suggestions.length > 0) {
            quickQuestions.innerHTML = '';
            suggestions.forEach(suggestion => {
                const btn = document.createElement('button');
                btn.className = 'quick-btn';
                btn.setAttribute('data-message', suggestion.text);
                btn.innerHTML = `<i class="fas ${suggestion.icon}"></i> ${suggestion.text}`;
                quickQuestions.appendChild(btn);
            });

            // Attach event listeners to new buttons
            document.querySelectorAll('.quick-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    sendQuickMessage(btn.getAttribute('data-message'));
                });
            });

            // Update timestamp
            conversationContext.lastSuggestionUpdate = new Date();
        }
    }

    function addMessage(content, sender) {
        const messagesContainer = document.getElementById('chat-messages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}-message`;

        const avatarDiv = document.createElement('div');
        avatarDiv.className = 'message-avatar';
        avatarDiv.innerHTML = sender === 'bot' ? '<i class="fas fa-robot"></i>' : '<i class="fas fa-user"></i>';

        const contentDiv = document.createElement('div');
        contentDiv.className = 'message-content';

        if (typeof content === 'string') {
            contentDiv.innerHTML = content.replace(/\n/g, '<br>');
        } else {
            contentDiv.appendChild(content);
        }

        messageDiv.appendChild(avatarDiv);
        messageDiv.appendChild(contentDiv);
        messagesContainer.appendChild(messageDiv);

        // Scroll to bottom
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function showTypingIndicator() {
        const messagesContainer = document.getElementById('chat-messages');
        const typingDiv = document.createElement('div');
        typingDiv.className = 'typing-indicator';
        typingDiv.id = 'typing-indicator';

        typingDiv.innerHTML = `
            <div class="message-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <i class="fas fa-robot"></i>
            </div>
            <div class="typing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        `;

        messagesContainer.appendChild(typingDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function hideTypingIndicator() {
        const typingIndicator = document.getElementById('typing-indicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    // Initialize chat with smarter welcome message
    // Setup emoji picker
    function setupEmojiPicker() {
        const emojiBtn = document.getElementById('chat-emoji-btn');
        const emojiPicker = document.getElementById('emoji-picker');
        const emojiContainer = document.getElementById('emoji-container');
        const chatInput = document.getElementById('chat-input');
        let isEmojiPickerOpen = false;

        // Common emojis
        const emojis = {
            recent: ['😊', '👍', '❤️', '🙏', '👏', '🎉', '🔥', '😂'],
            smileys: ['😀', '😃', '😄', '😁', '😆', '😅', '🤣', '😂', '🙂', '😉', '😊', '😇', '😍', '🤩', '😘', '😗'],
            objects: ['☕', '🍕', '🍔', '🍟', '📚', '💻', '📱', '🖨️', '🎓', '🎒', '🏫', '📝', '📌', '📎', '✏️', '🖊️'],
            symbols: ['❤️', '💯', '✅', '❌', '⭐', '🔥', '💫', '💦', '💨', '💪', '👍', '👎', '👏', '🙌', '👌', '✌️']
        };

        // Populate emoji container
        function populateEmojis(category) {
            emojiContainer.innerHTML = '';
            emojis[category].forEach(emoji => {
                const emojiElement = document.createElement('button');
                emojiElement.classList.add('emoji-item');
                emojiElement.textContent = emoji;
                emojiElement.addEventListener('click', () => {
                    chatInput.value += emoji;
                    chatInput.focus();
                });
                emojiContainer.appendChild(emojiElement);
            });
        }

        // Set initial emojis
        populateEmojis('recent');

        // Set up emoji category buttons
        document.querySelectorAll('.emoji-category').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.emoji-category').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                populateEmojis(btn.getAttribute('data-category'));
            });
        });

        // Toggle emoji picker
        emojiBtn.addEventListener('click', () => {
            if (isEmojiPickerOpen) {
                emojiPicker.style.display = 'none';
            } else {
                emojiPicker.style.display = 'block';
            }
            isEmojiPickerOpen = !isEmojiPickerOpen;
        });

        // Close emoji picker when clicking outside
        document.addEventListener('click', (e) => {
            if (!emojiPicker.contains(e.target) && e.target !== emojiBtn) {
                emojiPicker.style.display = 'none';
                isEmojiPickerOpen = false;
            }
        });
    }

    // Voice input support
    function setupVoiceInput() {
        const voiceBtn = document.getElementById('chat-voice-btn');
        const chatInput = document.getElementById('chat-input');

        // Check if browser supports speech recognition
        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            const recognition = new SpeechRecognition();

            recognition.continuous = false;
            recognition.lang = 'en-US';
            recognition.interimResults = false;
            recognition.maxAlternatives = 1;

            let isListening = false;

            voiceBtn.addEventListener('click', () => {
                if (isListening) {
                    recognition.stop();
                } else {
                    recognition.start();
                    voiceBtn.innerHTML = '<i class="fas fa-microphone-alt"></i>';
                    voiceBtn.classList.add('listening');
                }
            });

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                chatInput.value = transcript;
                // Auto-send after voice input
                setTimeout(() => sendMessage(), 300);
            };

            recognition.onend = () => {
                isListening = false;
                voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
                voiceBtn.classList.remove('listening');
            };

            recognition.onstart = () => {
                isListening = true;
            };

            recognition.onerror = (event) => {
                console.error('Speech recognition error', event.error);
                voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
                voiceBtn.classList.remove('listening');
            };
        } else {
            // Hide voice button if not supported
            voiceBtn.style.display = 'none';
        }
    }

    // Support for dark mode
    function setupDarkModeSupport() {
        // Listen for dark mode changes
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.attributeName === 'class') {
                    const isDarkMode = document.body.classList.contains('dark-mode');
                    // Update chatbot styling if needed
                    document.getElementById('chatbot-container').classList.toggle('dark-mode', isDarkMode);
                }
            });
        });

        // Start observing the document body for class changes
        observer.observe(document.body, { attributes: true });

        // Initial check
        if (document.body.classList.contains('dark-mode')) {
            document.getElementById('chatbot-container').classList.add('dark-mode');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Setup enhanced chatbot features
        setupEmojiPicker();
        setupVoiceInput();
        setupDarkModeSupport();

        // Add event listeners for chat actions
        document.getElementById('chat-toggle').addEventListener('click', toggleChat);
        document.getElementById('close-chat-btn').addEventListener('click', toggleChat);
        document.getElementById('clear-chat-btn').addEventListener('click', () => {
            document.getElementById('chat-messages').innerHTML = '';
            addMessage('I\'ve cleared our conversation. How can I help you now?', 'bot');
            localStorage.removeItem('utm_chat_history');
        });

        document.getElementById('chat-input').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        document.getElementById('send-btn').addEventListener('click', sendMessage);

        // Setup quick question buttons
        document.querySelectorAll('.quick-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                sendQuickMessage(btn.getAttribute('data-message'));
            });
        });

        // Show notification badge
        setTimeout(() => {
            const badge = document.getElementById('chat-badge');
            badge.style.display = 'flex';
            badge.textContent = '1';
        }, 3000);

        // Restore chat history if any
        try {
            const history = JSON.parse(localStorage.getItem('utm_chat_history') || '[]');
            if (history.length > 0) {
                // Only restore last 5 messages for performance
                const recentHistory = history.slice(-5);
                recentHistory.forEach(item => {
                    addMessage(item.message, item.sender);
                });

                // Add conversation continuation message
                if (history.length > 5) {
                    const helpMessage = "I've loaded your recent conversation history. Need more help with anything?";
                    setTimeout(() => addMessage(helpMessage, 'bot'), 500);
                }
            }
        } catch (e) {
            console.error('Error restoring chat history:', e);
        }
    });
</script>
