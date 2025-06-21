<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');
        $context = $request->input('context', []);

        // Enhanced response generation with database integration
        $response = $this->generateIntelligentResponse($message, $context);

        return response()->json([
            'success' => true,
            'message' => $response['text'],
            'context' => $response['context'],
            'suggestions' => $response['suggestions'] ?? []
        ]);
    }

    private function generateIntelligentResponse($message, $context = [])
    {
        $analysis = $this->analyzeMessage($message);

        // Get real-time data from database
        $realTimeData = $this->getRealTimeData($analysis);

        $response = [
            'text' => '',
            'context' => array_merge($context, [
                'last_intent' => $analysis['intent'],
                'user_mood' => $analysis['mood'],
                'timestamp' => now()
            ]),
            'suggestions' => []
        ];

        // Enhanced intent handling with personality
        switch ($analysis['intent']) {
            case 'greeting':
                $response = $this->handleGreeting($analysis, $context);
                break;
            case 'identity':
                $response = $this->handleIdentity($analysis);
                break;
            case 'wellbeing':
                $response = $this->handleWellbeing($analysis);
                break;
            case 'thanks':
                $response = $this->handleThanks($analysis);
                break;
            case 'compliment':
                $response = $this->handleCompliment($analysis);
                break;
            case 'suggestion':
                $response = $this->handlePersonalizedSuggestion($analysis, $realTimeData);
                break;
            case 'casual':
                $response = $this->handleCasualConversation($analysis, $realTimeData);
                break;
            case 'product_inquiry':
                $response = $this->handleProductInquiry($analysis, $realTimeData);
                break;
            case 'vendor_status':
                $response = $this->handleVendorStatus($analysis, $realTimeData);
                break;
            case 'order_tracking':
                $response = $this->handleOrderTracking($analysis, $realTimeData);
                break;
            case 'recommendation':
                $response = $this->handleRecommendation($analysis, $realTimeData);
                break;
            default:
                $response = $this->handleGeneralQuery($analysis, $realTimeData);
        }

        return $response;
    }

    private function analyzeMessage($message)
    {
        $message = strtolower(trim($message));

        // Enhanced intent detection with personality recognition
        $intents = [
            'greeting' => [
                'patterns' => ['/\b(hi|hello|hey|good morning|good afternoon|good evening|greetings|hola|sup|yo)\b/'],
                'confidence' => 0
            ],
            'identity' => [
                'patterns' => ['/\b(who are you|what are you|your name|tell me about yourself|introduce yourself)\b/'],
                'confidence' => 0
            ],
            'wellbeing' => [
                'patterns' => ['/\b(how are you|how are you doing|how\'s it going|what\'s up|how have you been)\b/'],
                'confidence' => 0
            ],
            'thanks' => [
                'patterns' => ['/\b(thank you|thanks|appreciate|grateful)\b/'],
                'confidence' => 0
            ],
            'compliment' => [
                'patterns' => ['/\b(good job|well done|amazing|awesome|great|excellent|perfect|you\'re great|love you|you\'re the best)\b/'],
                'confidence' => 0
            ],
            'suggestion' => [
                'patterns' => ['/\b(suggest|recommend|what should i|advice|help me choose|what do you think|opinion)\b/'],
                'confidence' => 0
            ],
            'casual' => [
                'patterns' => ['/\b(what\'s happening|how\'s life|what\'s new|tell me something|chat|talk|bored)\b/'],
                'confidence' => 0
            ],
            'product_inquiry' => [
                'patterns' => ['/\b(product|item|sell|available|stock|menu)\b/', '/\b(what do you have|what\'s available)\b/'],
                'confidence' => 0
            ],
            'vendor_status' => [
                'patterns' => ['/\b(open|closed|hours|time|available now)\b/', '/\b(is .* open)\b/'],
                'confidence' => 0
            ],
            'order_tracking' => [
                'patterns' => ['/\b(order|track|status|delivery|pickup)\b/', '/\b(my order|order status)\b/'],
                'confidence' => 0
            ],
            'recommendation' => [
                'patterns' => ['/\b(recommend|suggest|best|good|popular)\b/', '/\b(what should i)\b/'],
                'confidence' => 0
            ],
            'pricing' => [
                'patterns' => ['/\b(price|cost|how much|expensive|cheap)\b/'],
                'confidence' => 0
            ]
        ];

        // Calculate confidence scores
        foreach ($intents as $intent => &$data) {
            foreach ($data['patterns'] as $pattern) {
                if (preg_match($pattern, $message)) {
                    $data['confidence'] += 0.3;
                }
            }
        }

        // Find highest confidence intent
        $detectedIntent = 'general';
        $maxConfidence = 0;

        foreach ($intents as $intent => $data) {
            if ($data['confidence'] > $maxConfidence) {
                $maxConfidence = $data['confidence'];
                $detectedIntent = $intent;
            }
        }

        // Extract mood and entities
        $mood = 'neutral';
        if (preg_match('/\b(happy|excited|great|wonderful|amazing|love|perfect|fantastic)\b/', $message)) {
            $mood = 'positive';
        } elseif (preg_match('/\b(sad|disappointed|frustrated|angry|bad|terrible|awful|hate|problem|issue)\b/', $message)) {
            $mood = 'negative';
        }

        // Extract entities
        $vendors = [];
        $vendorKeywords = [
            'utm_mart' => ['utm', 'mart', 'university', 'campus'],
            'richiamo_caffe' => ['richiamo', 'caffe', 'coffee'],
            'setepak_printing' => ['setepak', 'printing', 'print']
        ];

        foreach ($vendorKeywords as $vendor => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($message, $keyword) !== false) {
                    $vendors[] = $vendor;
                    break;
                }
            }
        }

        return [
            'intent' => $detectedIntent,
            'confidence' => $maxConfidence,
            'vendors' => array_unique($vendors),
            'mood' => $mood,
            'original_message' => $message,
            'is_question' => strpos($message, '?') !== false,
            'word_count' => count(explode(' ', $message))
        ];
    }

    private function handleGreeting($analysis, $context)
    {
        $hour = now()->format('H');
        $timeGreeting = '';

        if ($hour < 12) $timeGreeting = 'Good morning';
        elseif ($hour < 17) $timeGreeting = 'Good afternoon';
        else $timeGreeting = 'Good evening';

        $greetings = [
            "Hello there! 👋 I'm Maya, your friendly UTM Commerce Connect assistant!",
            "Hi! 😊 Great to meet you! I'm Maya, and I'm here to help you with anything related to our campus vendors.",
            "Hey! 🌟 I'm Maya, your personal shopping assistant for UTM Commerce Connect!",
            "Hello! ✨ Maya here! I'm excited to help you discover amazing products and services on campus!"
        ];

        $greeting = $greetings[array_rand($greetings)];

        return [
            'text' => "$timeGreeting! $greeting\n\nI'm here to help you discover amazing products and services from our three fantastic campus vendors:\n🏪 UTM Mart - Your go-to place for all things UTM!\n☕ Richiamo Caffe - Perfect for coffee lovers and food enthusiasts!\n🖨️ Setepak Printing - Your academic printing partner!\n\nWhat can I help you explore today? 😊",
            'context' => array_merge($context, ['greeted' => true]),
            'suggestions' => ['Tell me about vendors', 'What\'s popular?', 'I need suggestions', 'What\'s open now?']
        ];
    }

    private function handleIdentity($analysis)
    {
        return [
            'text' => "Hi there! I'm Maya, your friendly UTM Commerce Connect Assistant! 🤖✨\n\nI'm here to make your campus shopping experience amazing! I know everything about our three wonderful vendors and I love helping students, faculty, and staff find exactly what they need.\n\nThink of me as your personal shopping buddy who's available 24/7! I can help you with:\n💡 Product recommendations\n🕒 Vendor hours and availability\n💰 Pricing information\n📍 Locations and contact details\n🛒 How to place orders\n\nI'm always learning and getting better at helping our UTM community! What would you like to know? 😊",
            'context' => ['introduced' => true],
            'suggestions' => ['How can you help me?', 'Tell me about vendors', 'What\'s popular?', 'Give me suggestions']
        ];
    }

    private function handleWellbeing($analysis)
    {
        $responses = [
            "I'm doing fantastic, thank you for asking! 😊 Helping people like you always makes my day brighter!",
            "I'm wonderful! Every conversation I have makes me better at helping our UTM community! How are you doing?",
            "I'm great! I love chatting with students and helping them discover amazing products and services! How's your day going?",
            "I'm doing amazing! Nothing makes me happier than helping people find what they need on campus! How are you feeling today?"
        ];

        $response = $responses[array_rand($responses)];

        if ($analysis['mood'] === 'positive') {
            $response .= "\n\nYou seem to be in a great mood! That's wonderful! Is there anything special you're looking for today? Maybe something to celebrate with? ☕🎉";
        } elseif ($analysis['mood'] === 'negative') {
            $response .= "\n\nI hope I can help brighten your day! Sometimes a good cup of coffee from Richiamo Caffe or finding that perfect item you need can really help! What can I do for you? 💪";
        } else {
            $response .= "\n\nWhat brings you to UTM Commerce Connect today? I'm excited to help! 🌟";
        }

        return [
            'text' => $response,
            'context' => ['wellbeing_checked' => true],
            'suggestions' => ['I need coffee', 'Show me products', 'What do you recommend?', 'Help me find something']
        ];
    }

    private function handleThanks($analysis)
    {
        $responses = [
            "You're very welcome! 😊",
            "Happy to help!",
            "My pleasure!",
            "Anytime! That's what I'm here for!"
        ];

        $response = $responses[array_rand($responses)];

        return [
            'text' => "$response\n\nIs there anything else I can help you with? I'm always here to make your campus shopping experience better! 🌟",
            'context' => ['thanked' => true],
            'suggestions' => ['Tell me more', 'What else can you do?', 'Show me vendors', 'I\'m done for now']
        ];
    }

    private function handleCompliment($analysis)
    {
        $responses = [
            "Thank you so much! That really makes my day! 😊",
            "You're too kind! I try my best to help!",
            "Aww, thank you! I love helping our UTM community!",
            "That means so much to me! I'm here to serve! ✨"
        ];

        $response = $responses[array_rand($responses)];

        return [
            'text' => "$response\n\nYour kind words really motivate me to keep helping our amazing UTM community! What can I assist you with today? ✨",
            'context' => ['complimented' => true],
            'suggestions' => ['Help me find something', 'What\'s popular?', 'Give me recommendations', 'Tell me about vendors']
        ];
    }

    private function handlePersonalizedSuggestion($analysis, $realTimeData)
    {
        $hour = now()->format('H');
        $day = now()->format('N'); // 1 = Monday, 7 = Sunday

        $suggestions = "🌟 Here are my personalized suggestions for you:\n\n";

        // Time-based suggestions
        if ($hour >= 7 && $hour <= 10) {
            $suggestions .= "🌅 Perfect Morning Picks:\n";
            $suggestions .= "☕ Start your day with Richiamo Caffe's energizing espresso or cappuccino\n";
            $suggestions .= "📚 Grab any study materials you need from UTM Mart\n";
            $suggestions .= "🖨️ Get your printing done early at Setepak - less crowded in the morning!\n\n";
        } elseif ($hour >= 11 && $hour <= 14) {
            $suggestions .= "🌞 Midday Recommendations:\n";
            $suggestions .= "🍽️ Try Richiamo Caffe's delicious Nasi Lemak or pasta dishes\n";
            $suggestions .= "☕ Perfect time for an iced coffee or smoothie to beat the heat\n";
            $suggestions .= "📋 Handle any printing needs while vendors are fully operational\n\n";
        } elseif ($hour >= 15 && $hour <= 18) {
            $suggestions .= "🌆 Afternoon Suggestions:\n";
            $suggestions .= "☕ Unwind with Richiamo's afternoon coffee specials\n";
            $suggestions .= "🛍️ Browse UTM Mart for any essentials you might need\n";
            $suggestions .= "📄 Last chance for printing services before they close\n\n";
        } else {
            $suggestions .= "🌙 Evening Planning:\n";
            $suggestions .= "📝 Plan tomorrow's needs - maybe some printing or study materials?\n";
            $suggestions .= "☕ Note down your coffee preferences for tomorrow's Richiamo visit\n";
            $suggestions .= "🛒 Add items to your wishlist for tomorrow's shopping\n\n";
        }

        $suggestions .= "What type of products or services are you most interested in? I can give you more specific recommendations! 😊";

        return [
            'text' => $suggestions,
            'context' => ['suggestions_given' => true],
            'suggestions' => ['UTM Mart products', 'Richiamo Caffe menu', 'Printing services', 'What\'s open now?']
        ];
    }

    private function handleCasualConversation($analysis, $realTimeData)
    {
        $responses = [
            "You know what's exciting? Our campus has such amazing vendors! Each one has its own unique personality and amazing offerings! What's your favorite spot so far?",
            "Life on campus is pretty great with all these convenient services! Have you tried exploring all three of our vendors yet?",
            "Things are always buzzing here at UTM Commerce Connect! Students are discovering new favorites every day. What kind of things do you usually look for?",
            "I love hearing about what's happening around campus! Are you working on any projects that might need our printing services? Or maybe you need a coffee break? ☕"
        ];

        return [
            'text' => $responses[array_rand($responses)],
            'context' => ['casual_chat' => true],
            'suggestions' => ['Tell me about vendors', 'I need coffee', 'Help with printing', 'Show me products']
        ];
    }

    private function getRealTimeData($analysis)
    {
        $data = [];

        // Get product data
        if (in_array('product_inquiry', [$analysis['intent']]) || !empty($analysis['vendors'])) {
            $query = Product::where('status', 1);

            if (!empty($analysis['vendors'])) {
                $vendorIds = [
                    'utm_mart' => 1,
                    'richiamo_caffe' => 3,
                    'setepak_printing' => 2
                ];

                $ids = array_map(fn($v) => $vendorIds[$v] ?? null, $analysis['vendors']);
                $query->whereIn('vendor_id', array_filter($ids));
            }

            $data['products'] = $query->take(5)->get();
        }

        // Get current time and vendor status
        $currentHour = Carbon::now()->format('H');
        $currentDay = Carbon::now()->format('N'); // 1 = Monday, 7 = Sunday

        $data['vendor_status'] = [
            'utm_mart' => $this->isVendorOpen('utm_mart', $currentHour, $currentDay),
            'richiamo_caffe' => $this->isVendorOpen('richiamo_caffe', $currentHour, $currentDay),
            'setepak_printing' => $this->isVendorOpen('setepak_printing', $currentHour, $currentDay)
        ];

        // Get recent order statistics
        $data['order_stats'] = Order::select('vendor_id')
            ->selectRaw('COUNT(*) as order_count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('vendor_id')
            ->get();

        return $data;
    }

    private function isVendorOpen($vendor, $hour, $day)
    {
        $schedules = [
            'utm_mart' => [
                'weekdays' => [
                    ['start' => 8, 'end' => 13],
                    ['start' => 14, 'end' => 17]
                ],
                'friday' => [
                    ['start' => 8, 'end' => 12],
                    ['start' => 14, 'end' => 17]
                ]
            ],
            'richiamo_caffe' => [
                'daily' => [['start' => 8, 'end' => 18]]
            ],
            'setepak_printing' => [
                'weekdays' => [['start' => 9, 'end' => 18]]
            ]
        ];

        $schedule = $schedules[$vendor] ?? [];

        if ($vendor === 'utm_mart') {
            $periods = $day === 5 ? $schedule['friday'] : $schedule['weekdays'];
        } elseif ($vendor === 'richiamo_caffe') {
            $periods = $schedule['daily'];
        } else {
            $periods = $day <= 5 ? $schedule['weekdays'] : [];
        }

        foreach ($periods as $period) {
            if ($hour >= $period['start'] && $hour < $period['end']) {
                return true;
            }
        }

        return false;
    }

    private function handleProductInquiry($analysis, $realTimeData)
    {
        $products = $realTimeData['products'] ?? collect();

        if ($products->isEmpty()) {
            return [
                'text' => "I can help you find products! Here's what our vendors offer:\n\n🏪 UTM Mart: University merchandise, books, stationery\n☕ Richiamo Caffe: Coffee, beverages, local food\n🖨️ Setepak Printing: Printing services, business cards\n\nWhich vendor interests you most?",
                'context' => ['intent' => 'product_inquiry'],
                'suggestions' => ['Show UTM Mart products', 'Show Richiamo Caffe menu', 'Show printing services']
            ];
        }

        $response = "🛍️ Here are some available products:\n\n";

        foreach ($products as $product) {
            $vendor = $this->getVendorName($product->vendor_id);
            $response .= "• {$product->name} - RM{$product->price} ({$vendor})\n";
        }

        $response .= "\nWould you like more details about any of these?";

        return [
            'text' => $response,
            'context' => ['intent' => 'product_inquiry', 'shown_products' => $products->pluck('id')->toArray()],
            'suggestions' => ['More products', 'Compare prices', 'How to order']
        ];
    }

    private function handleVendorStatus($analysis, $realTimeData)
    {
        $status = $realTimeData['vendor_status'];
        $response = "🕒 Current vendor status:\n\n";

        foreach ($status as $vendor => $isOpen) {
            $emoji = $isOpen ? '🟢' : '🔴';
            $statusText = $isOpen ? 'Open' : 'Closed';
            $vendorName = $this->getVendorDisplayName($vendor);
            $response .= "{$emoji} {$vendorName}: {$statusText}\n";
        }

        $openVendors = array_keys(array_filter($status));

        if (!empty($openVendors)) {
            $response .= "\n✨ You can order from the open vendors now!";
        } else {
            $response .= "\n😴 All vendors are currently closed. Check back during business hours!";
        }

        return [
            'text' => $response,
            'context' => ['intent' => 'vendor_status'],
            'suggestions' => ['View hours', 'Set reminder', 'Browse products']
        ];
    }

    private function handleOrderTracking($analysis, $realTimeData)
    {
        return [
            'text' => "📦 To track your order:\n\n1. Check your email for order confirmation\n2. Visit the 'Orders' page on the website\n3. Use your order ID to track status\n\nOrder statuses:\n🟡 Awaiting confirmation\n🔵 Ready to pick\n🟢 Done\n\nNeed help finding your order details?",
            'context' => ['intent' => 'order_tracking'],
            'suggestions' => ['View my orders', 'Contact vendor', 'Order help']
        ];
    }

    private function handleRecommendation($analysis, $realTimeData)
    {
        $hour = Carbon::now()->format('H');
        $recommendations = [];

        if ($hour >= 7 && $hour <= 11) {
            $recommendations[] = "☕ Start your day with Richiamo Caffe's fresh coffee";
            $recommendations[] = "📚 Pick up study materials from UTM Mart";
        } elseif ($hour >= 12 && $hour <= 17) {
            $recommendations[] = "🍽️ Try Richiamo Caffe's lunch specials";
            $recommendations[] = "📋 Get your printing done at Setepak Printing";
        } else {
            $recommendations[] = "☕ Unwind with Richiamo Caffe's evening beverages";
            $recommendations[] = "📖 Browse UTM Mart for tomorrow's needs";
        }

        $response = "🌟 Based on the current time, here are my recommendations:\n\n" . implode("\n", $recommendations);

        // Add popular products
        $orderStats = $realTimeData['order_stats'] ?? collect();
        if ($orderStats->isNotEmpty()) {
            $popularVendor = $orderStats->sortByDesc('order_count')->first();
            $vendorName = $this->getVendorName($popularVendor->vendor_id);
            $response .= "\n\n📈 {$vendorName} is trending this week - might be worth checking out!";
        }

        return [
            'text' => $response,
            'context' => ['intent' => 'recommendation'],
            'suggestions' => ['Browse trending', 'View all vendors', 'Personal suggestions']
        ];
    }

    private function handleGeneralQuery($analysis, $realTimeData)
    {
        return [
            'text' => "I'm here to help with UTM Commerce Connect! I can assist with:\n\n🛍️ Product information and availability\n⏰ Vendor hours and status\n📦 Order tracking and support\n💡 Personalized recommendations\n\nWhat would you like to know?",
            'context' => ['intent' => 'general'],
            'suggestions' => ['Show products', 'Vendor status', 'How to order', 'Get recommendations']
        ];
    }

    private function getVendorName($vendorId)
    {
        $vendors = [
            1 => 'UTM Mart',
            2 => 'Setepak Printing',
            3 => 'Richiamo Caffe'
        ];

        return $vendors[$vendorId] ?? 'Unknown Vendor';
    }

    private function getVendorDisplayName($vendorKey)
    {
        $vendors = [
            'utm_mart' => 'UTM Mart',
            'richiamo_caffe' => 'Richiamo Caffe',
            'setepak_printing' => 'Setepak Printing'
        ];

        return $vendors[$vendorKey] ?? $vendorKey;
    }
}
