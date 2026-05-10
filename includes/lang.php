<?php
/**
 * Language System — includes/lang.php
 * Supports all major world languages
 */

$languages = [
  'en' => ['name' => 'English',    'flag' => '🇬🇧', 'dir' => 'ltr'],
  'si' => ['name' => 'සිංහල',      'flag' => '🇱🇰', 'dir' => 'ltr'],
  // 'ta' => ['name' => 'தமிழ்',      'flag' => '🇮🇳', 'dir' => 'ltr'],
  'hi' => ['name' => 'हिन्दी',      'flag' => '🇮🇳', 'dir' => 'ltr'],
  'zh' => ['name' => '中文',        'flag' => '🇨🇳', 'dir' => 'ltr'],
  'ja' => ['name' => '日本語',      'flag' => '🇯🇵', 'dir' => 'ltr'],
  'ko' => ['name' => '한국어',      'flag' => '🇰🇷', 'dir' => 'ltr'],
  'ar' => ['name' => 'العربية',    'flag' => '🇸🇦', 'dir' => 'rtl'],
  'fr' => ['name' => 'Français',   'flag' => '🇫🇷', 'dir' => 'ltr'],
  'de' => ['name' => 'Deutsch',    'flag' => '🇩🇪', 'dir' => 'ltr'],
  'es' => ['name' => 'Español',    'flag' => '🇪🇸', 'dir' => 'ltr'],
  'pt' => ['name' => 'Português',  'flag' => '🇧🇷', 'dir' => 'ltr'],
  'ru' => ['name' => 'Русский',    'flag' => '🇷🇺', 'dir' => 'ltr'],
  'it' => ['name' => 'Italiano',   'flag' => '🇮🇹', 'dir' => 'ltr'],
  'tr' => ['name' => 'Türkçe',     'flag' => '🇹🇷', 'dir' => 'ltr'],
  'nl' => ['name' => 'Nederlands', 'flag' => '🇳🇱', 'dir' => 'ltr'],
  'pl' => ['name' => 'Polski',     'flag' => '🇵🇱', 'dir' => 'ltr'],
  'vi' => ['name' => 'Tiếng Việt', 'flag' => '🇻🇳', 'dir' => 'ltr'],
  'th' => ['name' => 'ภาษาไทย',   'flag' => '🇹🇭', 'dir' => 'ltr'],
  'id' => ['name' => 'Indonesia',  'flag' => '🇮🇩', 'dir' => 'ltr'],
  'ms' => ['name' => 'Melayu',     'flag' => '🇲🇾', 'dir' => 'ltr'],
  'fa' => ['name' => 'فارسی',      'flag' => '🇮🇷', 'dir' => 'rtl'],
  'ur' => ['name' => 'اردو',       'flag' => '🇵🇰', 'dir' => 'rtl'],
  'bn' => ['name' => 'বাংলা',      'flag' => '🇧🇩', 'dir' => 'ltr'],
  'sw' => ['name' => 'Kiswahili',  'flag' => '🇰🇪', 'dir' => 'ltr'],
];

$translations = [

  // ── Navigation ─────────────────────────────────────────
  'home' => [
    'en'=>'Home','si'=>'මුල් පිටුව','ta'=>'முகப்பு','hi'=>'होम','zh'=>'首页',
    'ja'=>'ホーム','ko'=>'홈','ar'=>'الرئيسية','fr'=>'Accueil','de'=>'Startseite',
    'es'=>'Inicio','pt'=>'Início','ru'=>'Главная','it'=>'Home','tr'=>'Ana Sayfa',
    'nl'=>'Home','pl'=>'Strona główna','vi'=>'Trang chủ','th'=>'หน้าแรก',
    'id'=>'Beranda','ms'=>'Laman Utama','fa'=>'خانه','ur'=>'ہوم','bn'=>'হোম','sw'=>'Nyumbani',
  ],
  'blog' => [
    'en'=>'Blog','si'=>'බ්ලොග්','ta'=>'வலைப்பதிவு','hi'=>'ब्लॉग','zh'=>'博客',
    'ja'=>'ブログ','ko'=>'블로그','ar'=>'المدونة','fr'=>'Blog','de'=>'Blog',
    'es'=>'Blog','pt'=>'Blog','ru'=>'Блог','it'=>'Blog','tr'=>'Blog',
    'nl'=>'Blog','pl'=>'Blog','vi'=>'Blog','th'=>'บล็อก',
    'id'=>'Blog','ms'=>'Blog','fa'=>'وبلاگ','ur'=>'بلاگ','bn'=>'ব্লগ','sw'=>'Blogu',
  ],
  // 'about' => [
  //   'en'=>'About','si'=>'අප ගැන','ta'=>'எங்களை பற்றி','hi'=>'हमारे बारे में','zh'=>'关于',
  //   'ja'=>'について','ko'=>'소개','ar'=>'حول','fr'=>'À propos','de'=>'Über uns',
  //   'es'=>'Acerca de','pt'=>'Sobre','ru'=>'О нас','it'=>'Chi siamo','tr'=>'Hakkında',
  //   'nl'=>'Over ons','pl'=>'O nas','vi'=>'Về chúng tôi','th'=>'เกี่ยวกับ',
  //   'id'=>'Tentang','ms'=>'Tentang','fa'=>'درباره','ur'=>'ہمارے بارے میں','bn'=>'আমাদের সম্পর্কে','sw'=>'Kuhusu',
  // ],
  'contact' => [
    'en'=>'Contact','si'=>'සම්බන්ධ වන්න','ta'=>'தொடர்பு','hi'=>'संपर्क','zh'=>'联系',
    'ja'=>'お問い合わせ','ko'=>'연락처','ar'=>'اتصل بنا','fr'=>'Contact','de'=>'Kontakt',
    'es'=>'Contacto','pt'=>'Contato','ru'=>'Контакт','it'=>'Contatto','tr'=>'İletişim',
    'nl'=>'Contact','pl'=>'Kontakt','vi'=>'Liên hệ','th'=>'ติดต่อ',
    'id'=>'Kontak','ms'=>'Hubungi','fa'=>'تماس','ur'=>'رابطہ','bn'=>'যোগাযোগ','sw'=>'Wasiliana',
  ],

  // ── Common UI ───────────────────────────────────────────
  'read_more' => [
    'en'=>'Read more','si'=>'තවත් කියවන්න','ta'=>'மேலும் படிக்க','hi'=>'और पढ़ें','zh'=>'阅读更多',
    'ja'=>'続きを読む','ko'=>'더 읽기','ar'=>'اقرأ المزيد','fr'=>'Lire la suite','de'=>'Mehr lesen',
    'es'=>'Leer más','pt'=>'Leia mais','ru'=>'Читать далее','it'=>'Leggi di più','tr'=>'Devamını oku',
    'nl'=>'Lees meer','pl'=>'Czytaj więcej','vi'=>'Đọc thêm','th'=>'อ่านเพิ่มเติม',
    'id'=>'Baca selengkapnya','ms'=>'Baca lagi','fa'=>'بیشتر بخوانید','ur'=>'مزید پڑھیں','bn'=>'আরও পড়ুন','sw'=>'Soma zaidi',
  ],
  'search' => [
    'en'=>'Search','si'=>'සොයන්න','ta'=>'தேடு','hi'=>'खोजें','zh'=>'搜索',
    'ja'=>'検索','ko'=>'검색','ar'=>'بحث','fr'=>'Rechercher','de'=>'Suchen',
    'es'=>'Buscar','pt'=>'Pesquisar','ru'=>'Поиск','it'=>'Cerca','tr'=>'Ara',
    'nl'=>'Zoeken','pl'=>'Szukaj','vi'=>'Tìm kiếm','th'=>'ค้นหา',
    'id'=>'Cari','ms'=>'Cari','fa'=>'جستجو','ur'=>'تلاش','bn'=>'অনুসন্ধান','sw'=>'Tafuta',
  ],
  'search_placeholder' => [
    'en'=>'Search articles…','si'=>'ලිපි සොයන්න…','ta'=>'கட்டுரைகளை தேடுங்கள்…','hi'=>'लेख खोजें…','zh'=>'搜索文章…',
    'ja'=>'記事を検索…','ko'=>'기사 검색…','ar'=>'ابحث في المقالات…','fr'=>'Rechercher des articles…','de'=>'Artikel suchen…',
    'es'=>'Buscar artículos…','pt'=>'Pesquisar artigos…','ru'=>'Поиск статей…','it'=>'Cerca articoli…','tr'=>'Makale ara…',
    'nl'=>'Zoek artikelen…','pl'=>'Szukaj artykułów…','vi'=>'Tìm bài viết…','th'=>'ค้นหาบทความ…',
    'id'=>'Cari artikel…','ms'=>'Cari artikel…','fa'=>'جستجوی مقالات…','ur'=>'مضامین تلاش کریں…','bn'=>'নিবন্ধ অনুসন্ধান করুন…','sw'=>'Tafuta makala…',
  ],
  'trending_now' => [
    'en'=>'Trending Now','si'=>'දැන් ජනප්‍රියයි','ta'=>'இப்போது பிரபலமானது','hi'=>'अभी ट्रेंडिंग','zh'=>'热门趋势',
    'ja'=>'トレンド中','ko'=>'지금 트렌딩','ar'=>'الأكثر رواجاً','fr'=>'Tendances actuelles','de'=>'Aktuell im Trend',
    'es'=>'Tendencias ahora','pt'=>'Em alta agora','ru'=>'В тренде','it'=>'Di tendenza','tr'=>'Şu an trend',
    'nl'=>'Nu trending','pl'=>'Teraz w trendzie','vi'=>'Đang thịnh hành','th'=>'กำลังเป็นที่นิยม',
    'id'=>'Sedang tren','ms'=>'Trending Sekarang','fa'=>'پرطرفدار','ur'=>'ابھی ٹرینڈنگ','bn'=>'এখন ট্রেন্ডিং','sw'=>'Inayoongezeka',
  ],
  'latest_stories' => [
    'en'=>'Latest Stories','si'=>'නවතම කතා','ta'=>'சமீபத்திய கதைகள்','hi'=>'नवीनतम कहानियां','zh'=>'最新故事',
    'ja'=>'最新ストーリー','ko'=>'최신 스토리','ar'=>'أحدث القصص','fr'=>'Dernières histoires','de'=>'Neueste Geschichten',
    'es'=>'Últimas historias','pt'=>'Últimas histórias','ru'=>'Последние истории','it'=>'Ultime storie','tr'=>'Son hikayeler',
    'nl'=>'Laatste verhalen','pl'=>'Najnowsze historie','vi'=>'Câu chuyện mới nhất','th'=>'เรื่องราวล่าสุด',
    'id'=>'Cerita Terbaru','ms'=>'Cerita Terbaru','fa'=>'آخرین داستان‌ها','ur'=>'تازہ ترین کہانیاں','bn'=>'সর্বশেষ গল্প','sw'=>'Hadithi za Hivi Karibuni',
  ],
  'view_all' => [
    'en'=>'View all','si'=>'සියල්ල බලන්න','ta'=>'அனைத்தையும் காண்க','hi'=>'सब देखें','zh'=>'查看全部',
    'ja'=>'すべて見る','ko'=>'전체 보기','ar'=>'عرض الكل','fr'=>'Voir tout','de'=>'Alle anzeigen',
    'es'=>'Ver todo','pt'=>'Ver tudo','ru'=>'Смотреть все','it'=>'Vedi tutto','tr'=>'Tümünü gör',
    'nl'=>'Alles bekijken','pl'=>'Zobacz wszystko','vi'=>'Xem tất cả','th'=>'ดูทั้งหมด',
    'id'=>'Lihat semua','ms'=>'Lihat semua','fa'=>'مشاهده همه','ur'=>'سب دیکھیں','bn'=>'সব দেখুন','sw'=>'Ona zote',
  ],
  'categories' => [
    'en'=>'Categories','si'=>'කාණ්ඩ','ta'=>'வகைகள்','hi'=>'श्रेणियां','zh'=>'分类',
    'ja'=>'カテゴリー','ko'=>'카테고리','ar'=>'الفئات','fr'=>'Catégories','de'=>'Kategorien',
    'es'=>'Categorías','pt'=>'Categorias','ru'=>'Категории','it'=>'Categorie','tr'=>'Kategoriler',
    'nl'=>'Categorieën','pl'=>'Kategorie','vi'=>'Danh mục','th'=>'หมวดหมู่',
    'id'=>'Kategori','ms'=>'Kategori','fa'=>'دسته‌بندی‌ها','ur'=>'زمرے','bn'=>'বিভাগ','sw'=>'Makundi',
  ],
  'browse_by_category' => [
    'en'=>'Browse by Category','si'=>'කාණ්ඩය අනුව පිරිසෙන්න','ta'=>'வகை வாரியாக உலாவுக','hi'=>'श्रेणी के अनुसार ब्राउज़ करें','zh'=>'按分类浏览',
    'ja'=>'カテゴリで閲覧','ko'=>'카테고리별 탐색','ar'=>'تصفح حسب الفئة','fr'=>'Parcourir par catégorie','de'=>'Nach Kategorie durchsuchen',
    'es'=>'Explorar por categoría','pt'=>'Navegar por categoria','ru'=>'Просмотр по категориям','it'=>'Sfoglia per categoria','tr'=>'Kategoriye göre gözat',
    'nl'=>'Bladeren op categorie','pl'=>'Przeglądaj według kategorii','vi'=>'Duyệt theo danh mục','th'=>'เรียกดูตามหมวดหมู่',
    'id'=>'Jelajahi berdasarkan kategori','ms'=>'Semak imbas mengikut kategori','fa'=>'مرور بر اساس دسته‌بندی','ur'=>'زمرے کے مطابق دیکھیں','bn'=>'বিভাগ অনুযায়ী ব্রাউজ করুন','sw'=>'Vinjari kwa Kitengo',
  ],
  'newsletter_title' => [
    'en'=>'Stories Worth Subscribing To','si'=>'දායක වීමට වටින කතා','ta'=>'குழுசேர்வதற்கு தகுந்த கதைகள்','hi'=>'सब्सक्राइब करने लायक कहानियां','zh'=>'值得订阅的故事',
    'ja'=>'購読する価値のあるストーリー','ko'=>'구독할 가치 있는 이야기','ar'=>'قصص تستحق الاشتراك','fr'=>'Des histoires qui valent l\'abonnement','de'=>'Geschichten, die es wert sind',
    'es'=>'Historias que vale la pena suscribir','pt'=>'Histórias que valem a assinatura','ru'=>'Истории, достойные подписки','it'=>'Storie che vale la pena seguire','tr'=>'Abone olmaya değer hikayeler',
    'nl'=>'Verhalen die het waard zijn','pl'=>'Historie warte subskrypcji','vi'=>'Những câu chuyện đáng đăng ký','th'=>'เรื่องราวที่ควรติดตาม',
    'id'=>'Cerita yang layak diikuti','ms'=>'Cerita yang patut dilanggan','fa'=>'داستان‌هایی ارزشمند برای دنبال کردن','ur'=>'سبسکرائب کرنے کے قابل کہانیاں','bn'=>'সদস্যতার যোগ্য গল্প','sw'=>'Hadithi zinazostahili kujisajili',
  ],
  'newsletter_subtitle' => [
    'en'=>'Join 12,000+ readers who get our best articles delivered weekly.','si'=>'සතිපතා හොඳම ලිපි ලබාගන්නා 12,000+ පාඨකයින් සමඟ එකතු වන්න.','ta'=>'வாராந்தர சிறந்த கட்டுரைகளைப் பெறும் 12,000+ வாசகர்களுடன் சேருங்கள்.','hi'=>'12,000+ पाठकों से जुड़ें जो साप्ताहिक हमारे सर्वश्रेष्ठ लेख प्राप्त करते हैं।','zh'=>'加入12,000+读者，每周收到我们最好的文章。',
    'ja'=>'毎週最高の記事を受け取る12,000人以上の読者に参加しましょう。','ko'=>'매주 최고의 기사를 받는 12,000명 이상의 독자와 함께하세요.','ar'=>'انضم إلى أكثر من 12,000 قارئ يحصلون على أفضل مقالاتنا أسبوعياً.','fr'=>'Rejoignez plus de 12 000 lecteurs qui reçoivent nos meilleurs articles chaque semaine.','de'=>'Schließen Sie sich 12.000+ Lesern an, die unsere besten Artikel wöchentlich erhalten.',
    'es'=>'Únete a más de 12.000 lectores que reciben nuestros mejores artículos semanalmente.','pt'=>'Junte-se a mais de 12.000 leitores que recebem nossos melhores artigos semanalmente.','ru'=>'Присоединяйтесь к 12 000+ читателям, получающим лучшие статьи еженедельно.','it'=>'Unisciti a oltre 12.000 lettori che ricevono i nostri migliori articoli ogni settimana.','tr'=>'Haftalık en iyi makalelerimizi alan 12.000+ okuyucuya katılın.',
    'nl'=>'Sluit je aan bij 12.000+ lezers die wekelijks onze beste artikelen ontvangen.','pl'=>'Dołącz do ponad 12 000 czytelników, którzy co tydzień otrzymują nasze najlepsze artykuły.','vi'=>'Tham gia 12.000+ độc giả nhận bài viết hay nhất mỗi tuần.','th'=>'เข้าร่วมกับผู้อ่านกว่า 12,000 คนที่รับบทความดีๆ ทุกสัปดาห์',
    'id'=>'Bergabunglah dengan 12.000+ pembaca yang menerima artikel terbaik kami setiap minggu.','ms'=>'Sertai 12,000+ pembaca yang menerima artikel terbaik kami setiap minggu.','fa'=>'به بیش از ۱۲،۰۰۰ خواننده بپیوندید که هر هفته بهترین مقالات ما را دریافت می‌کنند.','ur'=>'12,000+ قارئین کے ساتھ شامل ہوں جو ہر ہفتے بہترین مضامین حاصل کرتے ہیں۔','bn'=>'12,000+ পাঠকের সাথে যোগ দিন যারা প্রতি সপ্তাহে সেরা নিবন্ধ পান।','sw'=>'Jiunge na wasomaji 12,000+ wanaopokea makala yetu bora kila wiki.',
  ],
  'subscribe' => [
    'en'=>'Subscribe','si'=>'දායක වන්න','ta'=>'குழுசேர்','hi'=>'सदस्यता लें','zh'=>'订阅',
    'ja'=>'購読する','ko'=>'구독하기','ar'=>'اشترك','fr'=>'S\'abonner','de'=>'Abonnieren',
    'es'=>'Suscribirse','pt'=>'Assinar','ru'=>'Подписаться','it'=>'Iscriviti','tr'=>'Abone ol',
    'nl'=>'Abonneren','pl'=>'Subskrybuj','vi'=>'Đăng ký','th'=>'สมัครรับข้อมูล',
    'id'=>'Berlangganan','ms'=>'Langgan','fa'=>'مشترک شوید','ur'=>'سبسکرائب کریں','bn'=>'সদস্যতা নিন','sw'=>'Jiandikishe',
  ],
  'email_placeholder' => [
    'en'=>'Enter your email address','si'=>'ඔබේ විද්‍යුත් තැපැල් ලිපිනය ඇතුළත් කරන්න','ta'=>'உங்கள் மின்னஞ்சல் முகவரியை உள்ளிடுக','hi'=>'अपना ईमेल पता दर्ज करें','zh'=>'输入您的电子邮件地址',
    'ja'=>'メールアドレスを入力','ko'=>'이메일 주소 입력','ar'=>'أدخل عنوان بريدك الإلكتروني','fr'=>'Entrez votre adresse e-mail','de'=>'E-Mail-Adresse eingeben',
    'es'=>'Ingresa tu correo electrónico','pt'=>'Digite seu endereço de e-mail','ru'=>'Введите адрес электронной почты','it'=>'Inserisci il tuo indirizzo email','tr'=>'E-posta adresinizi girin',
    'nl'=>'Voer uw e-mailadres in','pl'=>'Wpisz swój adres e-mail','vi'=>'Nhập địa chỉ email của bạn','th'=>'กรอกที่อยู่อีเมลของคุณ',
    'id'=>'Masukkan alamat email Anda','ms'=>'Masukkan alamat e-mel anda','fa'=>'آدرس ایمیل خود را وارد کنید','ur'=>'اپنا ای میل پتہ درج کریں','bn'=>'আপনার ইমেইল ঠিকানা লিখুন','sw'=>'Ingiza anwani yako ya barua pepe',
  ],
  'articles' => [
    'en'=>'articles','si'=>'ලිපි','ta'=>'கட்டுரைகள்','hi'=>'लेख','zh'=>'篇文章',
    'ja'=>'記事','ko'=>'기사','ar'=>'مقالات','fr'=>'articles','de'=>'Artikel',
    'es'=>'artículos','pt'=>'artigos','ru'=>'статьи','it'=>'articoli','tr'=>'makale',
    'nl'=>'artikelen','pl'=>'artykułów','vi'=>'bài viết','th'=>'บทความ',
    'id'=>'artikel','ms'=>'artikel','fa'=>'مقاله','ur'=>'مضامین','bn'=>'নিবন্ধ','sw'=>'makala',
  ],
  'advertisement' => [
    'en'=>'Advertisement','si'=>'දැන්වීම','ta'=>'விளம்பரம்','hi'=>'विज्ञापन','zh'=>'广告',
    'ja'=>'広告','ko'=>'광고','ar'=>'إعلان','fr'=>'Publicité','de'=>'Werbung',
    'es'=>'Publicidad','pt'=>'Publicidade','ru'=>'Реклама','it'=>'Pubblicità','tr'=>'Reklam',
    'nl'=>'Advertentie','pl'=>'Reklama','vi'=>'Quảng cáo','th'=>'โฆษณา',
    'id'=>'Iklan','ms'=>'Iklan','fa'=>'تبلیغات','ur'=>'اشتہار','bn'=>'বিজ্ঞাপন','sw'=>'Tangazo',
  ],

  // ── Footer ──────────────────────────────────────────────
  'footer_desc' => [
    'en'=>'Stories that move you. Deep dives into love, psychology, mystery, horror, technology and financial freedom.',
    'si'=>'ඔබව ගෙනයන කතා. ආදරය, මනෝවිද්‍යාව, රහස්, භීෂණය, තාක්ෂණය සහ මූල්‍ය නිදහස ගැන ගැඹුරු විමසීම්.',
    'ta'=>'உங்களை நகர்த்தும் கதைகள். காதல், உளவியல், மர்மம், திகில், தொழில்நுட்பம் மற்றும் நிதி சுதந்திரம் பற்றிய ஆழமான ஆய்வுகள்.',
    'hi'=>'वे कहानियाँ जो आपको हिला दें। प्यार, मनोविज्ञान, रहस्य, डरावनी, तकनीक और वित्तीय स्वतंत्रता में गहरी खोज।',
    'zh'=>'触动你心的故事。深度探索爱情、心理学、神秘、恐怖、技术和财务自由。',
    'ja'=>'心を動かすストーリー。愛、心理学、ミステリー、ホラー、テクノロジー、そして経済的自由への深掘り。',
    'ko'=>'당신을 감동시키는 이야기. 사랑, 심리학, 미스터리, 공포, 기술, 금융 자유에 대한 심층 탐구.',
    'ar'=>'قصص تحرك مشاعرك. تعمق في الحب والنفسية والغموض والرعب والتكنولوجيا والحرية المالية.',
    'fr'=>'Des histoires qui vous touchent. Plongées profondes dans l\'amour, la psychologie, le mystère, l\'horreur, la technologie et la liberté financière.',
    'de'=>'Geschichten, die Sie bewegen. Tiefe Einblicke in Liebe, Psychologie, Mysterium, Horror, Technologie und finanzielle Freiheit.',
    'es'=>'Historias que te mueven. Inmersiones profundas en amor, psicología, misterio, terror, tecnología y libertad financiera.',
    'pt'=>'Histórias que te movem. Mergulhos profundos em amor, psicologia, mistério, terror, tecnologia e liberdade financeira.',
    'ru'=>'Истории, которые трогают. Глубокое погружение в любовь, психологию, тайну, ужасы, технологии и финансовую свободу.',
    'it'=>'Storie che ti emozionano. Approfondimenti su amore, psicologia, mistero, horror, tecnologia e libertà finanziaria.',
    'tr'=>'Sizi harekete geçiren hikayeler. Aşk, psikoloji, gizem, korku, teknoloji ve finansal özgürlük üzerine derin incelemeler.',
    'nl'=>'Verhalen die u raken. Diepgaande verkenning van liefde, psychologie, mysterie, horror, technologie en financiële vrijheid.',
    'pl'=>'Historie, które poruszają. Głębokie zanurzenie w miłość, psychologię, tajemnicę, horror, technologię i wolność finansową.',
    'vi'=>'Những câu chuyện làm bạn xúc động. Khám phá sâu về tình yêu, tâm lý, bí ẩn, kinh dị, công nghệ và tự do tài chính.',
    'th'=>'เรื่องราวที่ทำให้คุณรู้สึก. การสำรวจเชิงลึกเกี่ยวกับความรัก จิตวิทยา ความลึกลับ สยองขวัญ เทคโนโลยี และอิสรภาพทางการเงิน',
    'id'=>'Cerita yang menggerakkan Anda. Pendalaman tentang cinta, psikologi, misteri, horor, teknologi dan kebebasan finansial.',
    'ms'=>'Cerita yang menggerakkan anda. Penyelaman mendalam tentang cinta, psikologi, misteri, seram, teknologi dan kebebasan kewangan.',
    'fa'=>'داستان‌هایی که شما را به حرکت در می‌آورند. بررسی عمیق عشق، روانشناسی، رمز و راز، وحشت، فناوری و آزادی مالی.',
    'ur'=>'وہ کہانیاں جو آپ کو متحرک کریں۔ محبت، نفسیات، اسرار، ہارر، ٹیکنالوجی اور مالی آزادی میں گہرائی سے جائزہ۔',
    'bn'=>'যে গল্পগুলো আপনাকে নাড়া দেয়। ভালোবাসা, মনোবিজ্ঞান, রহস্য, ভয়াবহতা, প্রযুক্তি এবং আর্থিক স্বাধীনতার গভীর অন্বেষণ।',
    'sw'=>'Hadithi zinazokugusa. Uchunguzi wa kina wa upendo, saikolojia, fumbo, kutisha, teknolojia na uhuru wa kifedha.',
  ],
  'quick_links' => [
    'en'=>'Quick Links','si'=>'ඉක්මන් සබැඳි','ta'=>'விரைவு இணைப்புகள்','hi'=>'त्वरित लिंक','zh'=>'快速链接',
    'ja'=>'クイックリンク','ko'=>'빠른 링크','ar'=>'روابط سريعة','fr'=>'Liens rapides','de'=>'Schnelllinks',
    'es'=>'Enlaces rápidos','pt'=>'Links rápidos','ru'=>'Быстрые ссылки','it'=>'Link rapidi','tr'=>'Hızlı bağlantılar',
    'nl'=>'Snelle links','pl'=>'Szybkie linki','vi'=>'Liên kết nhanh','th'=>'ลิงก์ด่วน',
    'id'=>'Tautan cepat','ms'=>'Pautan pantas','fa'=>'لینک‌های سریع','ur'=>'فوری لنکس','bn'=>'দ্রুত লিঙ্ক','sw'=>'Viungo vya Haraka',
  ],
  'newsletter' => [
    'en'=>'Newsletter','si'=>'පුවත් පත','ta'=>'செய்திமடல்','hi'=>'न्यूज़लेटर','zh'=>'简报',
    'ja'=>'ニュースレター','ko'=>'뉴스레터','ar'=>'النشرة الإخبارية','fr'=>'Newsletter','de'=>'Newsletter',
    'es'=>'Boletín','pt'=>'Newsletter','ru'=>'Рассылка','it'=>'Newsletter','tr'=>'Bülten',
    'nl'=>'Nieuwsbrief','pl'=>'Newsletter','vi'=>'Bản tin','th'=>'จดหมายข่าว',
    'id'=>'Newsletter','ms'=>'Surat berita','fa'=>'خبرنامه','ur'=>'نیوز لیٹر','bn'=>'নিউজলেটার','sw'=>'Jarida',
  ],
  'no_spam' => [
    'en'=>'Get our best stories delivered weekly. No spam, ever.','si'=>'හොඳම කතා සතිපතා ලබාගන්න. කිසිදා spam නෑ.','ta'=>'சிறந்த கதைகளை வாராந்தர பெறுங்கள். எப்போதும் ஸ்பேம் இல்லை.','hi'=>'हमारी सर्वश्रेष्ठ कहानियाँ साप्ताहिक प्राप्त करें। कभी स्पैम नहीं।','zh'=>'每周获取我们最好的故事。永不垃圾邮件。',
    'ja'=>'最高のストーリーを毎週お届け。スパムは一切なし。','ko'=>'최고의 이야기를 매주 받아보세요. 스팸 없음.','ar'=>'احصل على أفضل قصصنا أسبوعياً. لا بريد مزعج أبداً.','fr'=>'Recevez nos meilleures histoires chaque semaine. Sans spam.','de'=>'Erhalten Sie unsere besten Geschichten wöchentlich. Kein Spam.',
    'es'=>'Recibe nuestras mejores historias semanalmente. Sin spam.','pt'=>'Receba nossas melhores histórias semanalmente. Sem spam.','ru'=>'Получайте лучшие истории каждую неделю. Никакого спама.','it'=>'Ricevi le nostre migliori storie ogni settimana. Nessuno spam.','tr'=>'En iyi hikayelerimizi haftalık alın. Spam yok.',
    'nl'=>'Ontvang onze beste verhalen wekelijks. Geen spam.','pl'=>'Otrzymuj nasze najlepsze historie co tydzień. Bez spamu.','vi'=>'Nhận những câu chuyện hay nhất mỗi tuần. Không spam.','th'=>'รับเรื่องราวดีๆ ทุกสัปดาห์ ไม่มีสแปม',
    'id'=>'Dapatkan cerita terbaik kami setiap minggu. Tanpa spam.','ms'=>'Dapatkan cerita terbaik kami setiap minggu. Tiada spam.','fa'=>'بهترین داستان‌های ما را هر هفته دریافت کنید. هرگز اسپم نیست.','ur'=>'ہفتہ وار بہترین کہانیاں پائیں۔ کبھی اسپام نہیں۔','bn'=>'প্রতি সপ্তাহে সেরা গল্পগুলি পান। কখনো স্প্যাম নেই।','sw'=>'Pokea hadithi zetu bora kila wiki. Bila barua taka.',
  ],
  'follow_us' => [
    'en'=>'Follow Us','si'=>'අපව අනුගමනය කරන්න','ta'=>'எங்களை பின்தொடருங்கள்','hi'=>'हमें फॉलो करें','zh'=>'关注我们',
    'ja'=>'フォローする','ko'=>'팔로우하기','ar'=>'تابعنا','fr'=>'Suivez-nous','de'=>'Folgen Sie uns',
    'es'=>'Síguenos','pt'=>'Siga-nos','ru'=>'Следите за нами','it'=>'Seguici','tr'=>'Bizi takip edin',
    'nl'=>'Volg ons','pl'=>'Obserwuj nas','vi'=>'Theo dõi chúng tôi','th'=>'ติดตามเรา',
    'id'=>'Ikuti kami','ms'=>'Ikuti kami','fa'=>'ما را دنبال کنید','ur'=>'ہمیں فالو کریں','bn'=>'আমাদের অনুসরণ করুন','sw'=>'Tufuate',
  ],
  'all_rights' => [
    'en'=>'All rights reserved.','si'=>'සියලු හිමිකම් ඇවිරිණි.','ta'=>'அனைத்து உரிமைகளும் பாதுகாக்கப்படுகின்றன.','hi'=>'सभी अधिकार सुरक्षित।','zh'=>'版权所有。',
    'ja'=>'全著作権所有。','ko'=>'모든 권리 보유.','ar'=>'جميع الحقوق محفوظة.','fr'=>'Tous droits réservés.','de'=>'Alle Rechte vorbehalten.',
    'es'=>'Todos los derechos reservados.','pt'=>'Todos os direitos reservados.','ru'=>'Все права защищены.','it'=>'Tutti i diritti riservati.','tr'=>'Tüm hakları saklıdır.',
    'nl'=>'Alle rechten voorbehouden.','pl'=>'Wszelkie prawa zastrzeżone.','vi'=>'Tất cả quyền được bảo lưu.','th'=>'สงวนลิขสิทธิ์',
    'id'=>'Semua hak dilindungi.','ms'=>'Hak cipta terpelihara.','fa'=>'تمام حقوق محفوظ است.','ur'=>'جملہ حقوق محفوظ ہیں۔','bn'=>'সমস্ত অধিকার সংরক্ষিত।','sw'=>'Haki zote zimehifadhiwa.',
  ],
  'privacy_policy' => [
    'en'=>'Privacy Policy','si'=>'පෞද්ගලිකත්ව ප්‍රතිපත්තිය','ta'=>'தனியுரிமைக் கொள்கை','hi'=>'गोपनीयता नीति','zh'=>'隐私政策',
    'ja'=>'プライバシーポリシー','ko'=>'개인정보 처리방침','ar'=>'سياسة الخصوصية','fr'=>'Politique de confidentialité','de'=>'Datenschutzrichtlinie',
    'es'=>'Política de privacidad','pt'=>'Política de Privacidade','ru'=>'Политика конфиденциальности','it'=>'Informativa sulla privacy','tr'=>'Gizlilik Politikası',
    'nl'=>'Privacybeleid','pl'=>'Polityka prywatności','vi'=>'Chính sách bảo mật','th'=>'นโยบายความเป็นส่วนตัว',
    'id'=>'Kebijakan Privasi','ms'=>'Dasar Privasi','fa'=>'سیاست حفظ حریم خصوصی','ur'=>'رازداری کی پالیسی','bn'=>'গোপনীয়তা নীতি','sw'=>'Sera ya Faragha',
  ],
  'terms_of_service' => [
    'en'=>'Terms of Service','si'=>'සේවා කොන්දේසි','ta'=>'சேவை விதிமுறைகள்','hi'=>'सेवा की शर्तें','zh'=>'服务条款',
    'ja'=>'利用規約','ko'=>'서비스 약관','ar'=>'شروط الخدمة','fr'=>'Conditions d\'utilisation','de'=>'Nutzungsbedingungen',
    'es'=>'Términos de servicio','pt'=>'Termos de Serviço','ru'=>'Условия использования','it'=>'Termini di servizio','tr'=>'Hizmet Şartları',
    'nl'=>'Servicevoorwaarden','pl'=>'Warunki korzystania z usług','vi'=>'Điều khoản dịch vụ','th'=>'ข้อกำหนดในการให้บริการ',
    'id'=>'Ketentuan Layanan','ms'=>'Terma Perkhidmatan','fa'=>'شرایط خدمات','ur'=>'خدمات کی شرائط','bn'=>'সেবার শর্তাবলী','sw'=>'Masharti ya Huduma',
  ],
  'sitemap' => [
    'en'=>'Sitemap','si'=>'අඩවි සිතියම','ta'=>'தள வரைபடம்','hi'=>'साइटमैप','zh'=>'网站地图',
    'ja'=>'サイトマップ','ko'=>'사이트맵','ar'=>'خريطة الموقع','fr'=>'Plan du site','de'=>'Sitemap',
    'es'=>'Mapa del sitio','pt'=>'Mapa do site','ru'=>'Карта сайта','it'=>'Mappa del sito','tr'=>'Site haritası',
    'nl'=>'Sitemap','pl'=>'Mapa strony','vi'=>'Sơ đồ trang web','th'=>'แผนผังเว็บไซต์',
    'id'=>'Peta situs','ms'=>'Peta laman','fa'=>'نقشه سایت','ur'=>'سائٹ میپ','bn'=>'সাইটম্যাপ','sw'=>'Ramani ya Tovuti',
  ],
  'select_language' => [
    'en'=>'Select Language','si'=>'භාෂාව තෝරන්න','ta'=>'மொழியைத் தேர்ந்தெடுக்கவும்','hi'=>'भाषा चुनें','zh'=>'选择语言',
    'ja'=>'言語を選択','ko'=>'언語 선택','ar'=>'اختر اللغة','fr'=>'Choisir la langue','de'=>'Sprache wählen',
    'es'=>'Seleccionar idioma','pt'=>'Selecionar idioma','ru'=>'Выбрать язык','it'=>'Seleziona lingua','tr'=>'Dil seçin',
    'nl'=>'Taal selecteren','pl'=>'Wybierz język','vi'=>'Chọn ngôn ngữ','th'=>'เลือกภาษา',
    'id'=>'Pilih bahasa','ms'=>'Pilih bahasa','fa'=>'انتخاب زبان','ur'=>'زبان منتخب کریں','bn'=>'ভাষা নির্বাচন করুন','sw'=>'Chagua Lugha',
  ],
  'crafted_for' => [
    'en'=>'Crafted with','si'=>'ආදරයෙන් නිර්මාණය කළා','ta'=>'அன்புடன் உருவாக்கப்பட்டது','hi'=>'प्यार से बनाया','zh'=>'用爱制作',
    'ja'=>'愛を込めて制作','ko'=>'사랑으로 만든','ar'=>'صُنع بـ','fr'=>'Créé avec','de'=>'Mit Liebe erstellt',
    'es'=>'Creado con','pt'=>'Criado com','ru'=>'Создано с','it'=>'Creato con','tr'=>'ile yapıldı',
    'nl'=>'Gemaakt met','pl'=>'Stworzone z','vi'=>'Tạo ra với','th'=>'สร้างด้วย',
    'id'=>'Dibuat dengan','ms'=>'Dibuat dengan','fa'=>'ساخته شده با','ur'=>'کے ساتھ بنایا گیا','bn'=>'দিয়ে তৈরি','sw'=>'Imetengenezwa na',
  ],
  'for_curious_minds' => [
    'en'=>'for curious minds.','si'=>'කුතුහලවන්ත මනස් සඳහා.','ta'=>'ஆர்வமுள்ள மனங்களுக்காக.','hi'=>'जिज्ञासु मन के लिए।','zh'=>'为好奇的心灵。',
    'ja'=>'好奇心旺盛な心のために。','ko'=>'호기심 많은 마음을 위해.','ar'=>'للعقول الفضولية.','fr'=>'pour les esprits curieux.','de'=>'für neugierige Köpfe.',
    'es'=>'para mentes curiosas.','pt'=>'para mentes curiosas.','ru'=>'для любознательных умов.','it'=>'per menti curiose.','tr'=>'meraklı zihinler için.',
    'nl'=>'voor nieuwsgierige geesten.','pl'=>'dla ciekawskich umysłów.','vi'=>'cho những tâm hồn tò mò.','th'=>'สำหรับจิตใจที่อยากรู้อยากเห็น',
    'id'=>'untuk pikiran yang penasaran.','ms'=>'untuk minda yang ingin tahu.','fa'=>'برای ذهن‌های کنجکاو.','ur'=>'متجسس ذہنوں کے لیے۔','bn'=>'কৌতূহলী মনের জন্য।','sw'=>'kwa akili za udadisi.',
  ],
];

// Get current language
function getCurrentLang(): string {
    if (isset($_GET['lang']) && isset($GLOBALS['languages'][$_GET['lang']])) {
        $_SESSION['lang'] = $_GET['lang'];
    }
    return $_SESSION['lang'] ?? 'en';
}

// Translate function
function t(string $key): string {
    global $translations;
    $lang = getCurrentLang();
    return $translations[$key][$lang] ?? $translations[$key]['en'] ?? $key;
}

// Get text direction
function getLangDir(): string {
    global $languages;
    $lang = getCurrentLang();
    return $languages[$lang]['dir'] ?? 'ltr';
}


$translations += [
  'all_articles' => [
    'en'=>'All Articles','si'=>'සියලු ලිපි','ta'=>'அனைத்து கட்டுரைகள்','hi'=>'सभी लेख','zh'=>'所有文章',
    'ja'=>'全記事','ko'=>'모든 기사','ar'=>'جميع المقالات','fr'=>'Tous les articles','de'=>'Alle Artikel',
    'es'=>'Todos los artículos','pt'=>'Todos os artigos','ru'=>'Все статьи','it'=>'Tutti gli articoli','tr'=>'Tüm makaleler',
    'nl'=>'Alle artikelen','pl'=>'Wszystkie artykuły','vi'=>'Tất cả bài viết','th'=>'บทความทั้งหมด',
    'id'=>'Semua artikel','ms'=>'Semua artikel','fa'=>'همه مقالات','ur'=>'تمام مضامین','bn'=>'সব নিবন্ধ','sw'=>'Makala Zote',
  ],
  'all' => [
    'en'=>'All','si'=>'සියල්ල','ta'=>'அனைத்தும்','hi'=>'सभी','zh'=>'全部',
    'ja'=>'すべて','ko'=>'전체','ar'=>'الكل','fr'=>'Tout','de'=>'Alle',
    'es'=>'Todo','pt'=>'Tudo','ru'=>'Все','it'=>'Tutti','tr'=>'Hepsi',
    'nl'=>'Alle','pl'=>'Wszystkie','vi'=>'Tất cả','th'=>'ทั้งหมด',
    'id'=>'Semua','ms'=>'Semua','fa'=>'همه','ur'=>'سب','bn'=>'সব','sw'=>'Zote',
  ],
  'found' => [
    'en'=>'found','si'=>'හමු විය','ta'=>'கண்டுபிடிக்கப்பட்டது','hi'=>'मिले','zh'=>'找到',
    'ja'=>'件見つかりました','ko'=>'개 발견','ar'=>'تم العثور عليها','fr'=>'trouvés','de'=>'gefunden',
    'es'=>'encontrados','pt'=>'encontrados','ru'=>'найдено','it'=>'trovati','tr'=>'bulundu',
    'nl'=>'gevonden','pl'=>'znalezionych','vi'=>'tìm thấy','th'=>'พบ',
    'id'=>'ditemukan','ms'=>'dijumpai','fa'=>'یافت شد','ur'=>'ملے','bn'=>'পাওয়া গেছে','sw'=>'zimepatikana',
  ],
  'no_articles_found' => [
    'en'=>'No articles found','si'=>'ලිපි හමු නොවීය','ta'=>'கட்டுரைகள் எதுவும் இல்லை','hi'=>'कोई लेख नहीं मिला','zh'=>'未找到文章',
    'ja'=>'記事が見つかりません','ko'=>'기사를 찾을 수 없습니다','ar'=>'لا توجد مقالات','fr'=>'Aucun article trouvé','de'=>'Keine Artikel gefunden',
    'es'=>'No se encontraron artículos','pt'=>'Nenhum artigo encontrado','ru'=>'Статьи не найдены','it'=>'Nessun articolo trovato','tr'=>'Makale bulunamadı',
    'nl'=>'Geen artikelen gevonden','pl'=>'Nie znaleziono artykułów','vi'=>'Không tìm thấy bài viết','th'=>'ไม่พบบทความ',
    'id'=>'Tidak ada artikel ditemukan','ms'=>'Tiada artikel ditemui','fa'=>'مقاله‌ای یافت نشد','ur'=>'کوئی مضمون نہیں ملا','bn'=>'কোনো নিবন্ধ পাওয়া যায়নি','sw'=>'Hakuna makala iliyopatikana',
  ],
  'try_different_search' => [
    'en'=>'Try a different search term.','si'=>'වෙනත් සෙවුම් වචනයක් උත්සාහ කරන්න.','ta'=>'வேறு தேடல் சொல்லை முயற்சிக்கவும்.','hi'=>'कोई अलग खोज शब्द आज़माएं।','zh'=>'请尝试其他搜索词。',
    'ja'=>'別のキーワードで検索してください。','ko'=>'다른 검색어를 시도해 보세요.','ar'=>'جرب كلمة بحث مختلفة.','fr'=>'Essayez un autre terme de recherche.','de'=>'Versuchen Sie einen anderen Suchbegriff.',
    'es'=>'Intente con un término de búsqueda diferente.','pt'=>'Tente um termo de pesquisa diferente.','ru'=>'Попробуйте другой поисковый запрос.','it'=>'Prova un termine di ricerca diverso.','tr'=>'Farklı bir arama terimi deneyin.',
    'nl'=>'Probeer een andere zoekterm.','pl'=>'Spróbuj innego hasła wyszukiwania.','vi'=>'Thử một từ khóa tìm kiếm khác.','th'=>'ลองใช้คำค้นหาอื่น',
    'id'=>'Coba kata pencarian yang berbeda.','ms'=>'Cuba kata carian yang berbeza.','fa'=>'یک عبارت جستجوی دیگر امتحان کنید.','ur'=>'مختلف تلاشی اصطلاح آزمائیں۔','bn'=>'ভিন্ন অনুসন্ধান শব্দ ব্যবহার করুন।','sw'=>'Jaribu neno tofauti la kutafuta.',
  ],
  'no_posts_category' => [
    'en'=>'No posts in this category yet.','si'=>'මෙම කාණ්ඩයේ තවම ලිපි නෑ.','ta'=>'இந்த வகையில் இன்னும் இடுகைகள் இல்லை.','hi'=>'इस श्रेणी में अभी तक कोई पोस्ट नहीं।','zh'=>'此分类暂无文章。',
    'ja'=>'このカテゴリにはまだ記事がありません。','ko'=>'이 카테고리에 아직 게시물이 없습니다.','ar'=>'لا توجد مشاركات في هذه الفئة بعد.','fr'=>'Aucun article dans cette catégorie pour l\'instant.','de'=>'Noch keine Beiträge in dieser Kategorie.',
    'es'=>'Aún no hay artículos en esta categoría.','pt'=>'Ainda não há artigos nesta categoria.','ru'=>'В этой категории пока нет статей.','it'=>'Ancora nessun articolo in questa categoria.','tr'=>'Bu kategoride henüz gönderi yok.',
    'nl'=>'Nog geen berichten in deze categorie.','pl'=>'Brak wpisów w tej kategorii.','vi'=>'Chưa có bài viết trong danh mục này.','th'=>'ยังไม่มีบทความในหมวดหมู่นี้',
    'id'=>'Belum ada postingan di kategori ini.','ms'=>'Tiada siaran dalam kategori ini lagi.','fa'=>'هنوز هیچ پستی در این دسته‌بندی نیست.','ur'=>'اس زمرے میں ابھی تک کوئی پوسٹ نہیں۔','bn'=>'এই বিভাগে এখনো কোনো পোস্ট নেই।','sw'=>'Bado hakuna machapisho katika kitengo hiki.',
  ],
  'browse_all' => [
    'en'=>'Browse All','si'=>'සියල්ල බලන්න','ta'=>'அனைத்தையும் உலாவுக','hi'=>'सब ब्राउज़ करें','zh'=>'浏览全部',
    'ja'=>'すべて閲覧','ko'=>'전체 탐색','ar'=>'تصفح الكل','fr'=>'Parcourir tout','de'=>'Alle durchsuchen',
    'es'=>'Ver todos','pt'=>'Ver todos','ru'=>'Просмотреть все','it'=>'Sfoglia tutti','tr'=>'Tümüne göz at',
    'nl'=>'Alles bekijken','pl'=>'Przeglądaj wszystkie','vi'=>'Xem tất cả','th'=>'ดูทั้งหมด',
    'id'=>'Lihat semua','ms'=>'Semak imbas semua','fa'=>'همه را مرور کنید','ur'=>'سب دیکھیں','bn'=>'সব দেখুন','sw'=>'Vinjari Zote',
  ],
  'comments_label' => [
    'en'=>'Comments','si'=>'අදහස්','ta'=>'கருத்துகள்','hi'=>'टिप्पणियाँ','zh'=>'评论',
    'ja'=>'コメント','ko'=>'댓글','ar'=>'التعليقات','fr'=>'Commentaires','de'=>'Kommentare',
    'es'=>'Comentarios','pt'=>'Comentários','ru'=>'Комментарии','it'=>'Commenti','tr'=>'Yorumlar',
    'nl'=>'Reacties','pl'=>'Komentarze','vi'=>'Bình luận','th'=>'ความคิดเห็น',
    'id'=>'Komentar','ms'=>'Komen','fa'=>'نظرات','ur'=>'تبصرے','bn'=>'মন্তব্য','sw'=>'Maoni',
  ],
  'be_first_comment' => [
    'en'=>'Be the first to share your thoughts!','si'=>'ඔබේ අදහස් පළමුව බෙදාගන්න!','ta'=>'உங்கள் எண்ணங்களை முதலில் பகிருங்கள்!','hi'=>'अपने विचार साझा करने वाले पहले बनें!','zh'=>'第一个分享您的想法！',
    'ja'=>'最初にご意見をシェアしましょう！','ko'=>'첫 번째로 생각을 공유하세요!','ar'=>'كن أول من يشارك أفكاره!','fr'=>'Soyez le premier à partager vos pensées!','de'=>'Seien Sie der Erste, der seine Gedanken teilt!',
    'es'=>'¡Sé el primero en compartir tus pensamientos!','pt'=>'Seja o primeiro a compartilhar seus pensamentos!','ru'=>'Будьте первым, кто поделится своими мыслями!','it'=>'Sii il primo a condividere i tuoi pensieri!','tr'=>'Düşüncelerinizi ilk paylaşan siz olun!',
    'nl'=>'Wees de eerste om uw gedachten te delen!','pl'=>'Bądź pierwszą osobą, która podzieli się swoimi przemyśleniami!','vi'=>'Hãy là người đầu tiên chia sẻ suy nghĩ của bạn!','th'=>'เป็นคนแรกที่แบ่งปันความคิดของคุณ!',
    'id'=>'Jadilah yang pertama berbagi pemikiran Anda!','ms'=>'Jadilah yang pertama berkongsi pendapat anda!','fa'=>'اولین نفری باشید که نظرات خود را به اشتراک می‌گذارید!','ur'=>'اپنے خیالات پہلے شیئر کریں!','bn'=>'প্রথমে আপনার মতামত শেয়ার করুন!','sw'=>'Kuwa wa kwanza kushiriki mawazo yako!',
  ],
  'leave_comment' => [
    'en'=>'Leave a Comment','si'=>'අදහසක් ලියන්න','ta'=>'கருத்து தெரிவிக்கவும்','hi'=>'टिप्पणी छोड़ें','zh'=>'发表评论',
    'ja'=>'コメントを残す','ko'=>'댓글 남기기','ar'=>'اترك تعليقاً','fr'=>'Laisser un commentaire','de'=>'Kommentar hinterlassen',
    'es'=>'Dejar un comentario','pt'=>'Deixar um comentário','ru'=>'Оставить комментарий','it'=>'Lascia un commento','tr'=>'Yorum bırak',
    'nl'=>'Reactie achterlaten','pl'=>'Zostaw komentarz','vi'=>'Để lại bình luận','th'=>'แสดงความคิดเห็น',
    'id'=>'Tinggalkan komentar','ms'=>'Tinggalkan komen','fa'=>'نظر بگذارید','ur'=>'تبصرہ کریں','bn'=>'মন্তব্য করুন','sw'=>'Acha Maoni',
  ],
  'post_comment' => [
    'en'=>'Post Comment','si'=>'අදහස යොමු කරන්න','ta'=>'கருத்து இடுக','hi'=>'टिप्पणी पोस्ट करें','zh'=>'发表评论',
    'ja'=>'コメントする','ko'=>'댓글 게시','ar'=>'نشر التعليق','fr'=>'Publier le commentaire','de'=>'Kommentar senden',
    'es'=>'Publicar comentario','pt'=>'Publicar comentário','ru'=>'Отправить комментарий','it'=>'Pubblica commento','tr'=>'Yorum yayınla',
    'nl'=>'Reactie plaatsen','pl'=>'Opublikuj komentarz','vi'=>'Đăng bình luận','th'=>'โพสต์ความคิดเห็น',
    'id'=>'Kirim komentar','ms'=>'Hantar komen','fa'=>'ارسال نظر','ur'=>'تبصرہ پوسٹ کریں','bn'=>'মন্তব্য পোস্ট করুন','sw'=>'Chapisha Maoni',
  ],
  'comment_thanks' => [
    'en'=>'Thank you! Your comment is awaiting moderation.','si'=>'ස්තූතියි! ඔබේ අදහස අනුමැතිය බලාපොරොත්තු වෙමින් ඇත.','ta'=>'நன்றி! உங்கள் கருத்து மதிப்பாய்விற்காக காத்திருக்கிறது.','hi'=>'धन्यवाद! आपकी टिप्पणी अनुमोदन की प्रतीक्षा में है।','zh'=>'谢谢！您的评论正在等待审核。',
    'ja'=>'ありがとうございます！コメントは承認待ちです。','ko'=>'감사합니다! 댓글이 검토 중입니다.','ar'=>'شكراً! تعليقك في انتظار المراجعة.','fr'=>'Merci ! Votre commentaire est en attente de modération.','de'=>'Danke! Ihr Kommentar wartet auf Genehmigung.',
    'es'=>'¡Gracias! Tu comentario está pendiente de moderación.','pt'=>'Obrigado! Seu comentário aguarda moderação.','ru'=>'Спасибо! Ваш комментарий ожидает проверки.','it'=>'Grazie! Il tuo commento è in attesa di moderazione.','tr'=>'Teşekkürler! Yorumunuz onay bekliyor.',
    'nl'=>'Bedankt! Uw reactie wacht op moderatie.','pl'=>'Dziękujemy! Twój komentarz czeka na moderację.','vi'=>'Cảm ơn! Bình luận của bạn đang chờ kiểm duyệt.','th'=>'ขอบคุณ! ความคิดเห็นของคุณกำลังรอการตรวจสอบ',
    'id'=>'Terima kasih! Komentar Anda menunggu moderasi.','ms'=>'Terima kasih! Komen anda sedang menunggu moderasi.','fa'=>'ممنون! نظر شما در انتظار بررسی است.','ur'=>'شکریہ! آپ کا تبصرہ جائزے کا انتظار کر رہا ہے۔','bn'=>'ধন্যবাদ! আপনার মন্তব্য অনুমোদনের অপেক্ষায় আছে।','sw'=>'Asante! Maoni yako yanasubiri ukaguzi.',
  ],
  'comment_error' => [
    'en'=>'Please fill in your name and a comment (min 10 characters).','si'=>'කරුණාකර ඔබේ නම සහ අදහස ඇතුළත් කරන්න (අවම 10 අකුරු).','ta'=>'உங்கள் பெயர் மற்றும் கருத்தை நிரப்பவும் (குறைந்தது 10 எழுத்துகள்).','hi'=>'कृपया अपना नाम और टिप्पणी भरें (न्यूनतम 10 अक्षर)।','zh'=>'请填写您的姓名和评论（至少10个字符）。',
    'ja'=>'名前とコメントを入力してください（最低10文字）。','ko'=>'이름과 댓글을 입력해 주세요 (최소 10자).','ar'=>'يرجى ملء اسمك وتعليقك (10 أحرف على الأقل).','fr'=>'Veuillez remplir votre nom et un commentaire (min 10 caractères).','de'=>'Bitte Name und Kommentar eingeben (min. 10 Zeichen).',
    'es'=>'Por favor rellena tu nombre y un comentario (mín. 10 caracteres).','pt'=>'Por favor preencha seu nome e um comentário (mín. 10 caracteres).','ru'=>'Пожалуйста, заполните имя и комментарий (мин. 10 символов).','it'=>'Compila nome e commento (min 10 caratteri).','tr'=>'Lütfen adınızı ve bir yorum girin (en az 10 karakter).',
    'nl'=>'Vul uw naam en een reactie in (min. 10 tekens).','pl'=>'Wypełnij imię i komentarz (min. 10 znaków).','vi'=>'Vui lòng điền tên và bình luận (tối thiểu 10 ký tự).','th'=>'กรุณากรอกชื่อและความคิดเห็น (อย่างน้อย 10 ตัวอักษร)',
    'id'=>'Harap isi nama dan komentar (min 10 karakter).','ms'=>'Sila isi nama dan komen (min 10 aksara).','fa'=>'لطفاً نام و نظر خود را پر کنید (حداقل ۱۰ کاراکتر).','ur'=>'براہ کرم اپنا نام اور تبصرہ بھریں (کم از کم 10 حروف)۔','bn'=>'অনুগ্রহ করে আপনার নাম ও মন্তব্য পূরণ করুন (কমপক্ষে ১০ অক্ষর)।','sw'=>'Tafadhali jaza jina lako na maoni (herufi 10 au zaidi).',
  ],
  'your_name' => [
    'en'=>'Name','si'=>'නම','ta'=>'பெயர்','hi'=>'नाम','zh'=>'姓名',
    'ja'=>'お名前','ko'=>'이름','ar'=>'الاسم','fr'=>'Nom','de'=>'Name',
    'es'=>'Nombre','pt'=>'Nome','ru'=>'Имя','it'=>'Nome','tr'=>'Ad',
    'nl'=>'Naam','pl'=>'Imię','vi'=>'Tên','th'=>'ชื่อ',
    'id'=>'Nama','ms'=>'Nama','fa'=>'نام','ur'=>'نام','bn'=>'নাম','sw'=>'Jina',
  ],
  'your_email' => [
    'en'=>'Email','si'=>'විද්‍යුත් තැපෑල','ta'=>'மின்னஞ்சல்','hi'=>'ईमेल','zh'=>'邮箱',
    'ja'=>'メール','ko'=>'이메일','ar'=>'البريد الإلكتروني','fr'=>'E-mail','de'=>'E-Mail',
    'es'=>'Correo','pt'=>'Email','ru'=>'Email','it'=>'Email','tr'=>'E-posta',
    'nl'=>'E-mail','pl'=>'E-mail','vi'=>'Email','th'=>'อีเมล',
    'id'=>'Email','ms'=>'E-mel','fa'=>'ایمیل','ur'=>'ای میل','bn'=>'ইমেইল','sw'=>'Barua pepe',
  ],
  'optional' => [
    'en'=>'optional','si'=>'විකල්ප','ta'=>'விருப்பமானது','hi'=>'वैकल्पिक','zh'=>'可选',
    'ja'=>'任意','ko'=>'선택 사항','ar'=>'اختياري','fr'=>'optionnel','de'=>'optional',
    'es'=>'opcional','pt'=>'opcional','ru'=>'необязательно','it'=>'facoltativo','tr'=>'isteğe bağlı',
    'nl'=>'optioneel','pl'=>'opcjonalne','vi'=>'tùy chọn','th'=>'ไม่บังคับ',
    'id'=>'opsional','ms'=>'pilihan','fa'=>'اختیاری','ur'=>'اختیاری','bn'=>'ঐচ্ছিক','sw'=>'si lazima',
  ],
  'comment_label' => [
    'en'=>'Comment','si'=>'අදහස','ta'=>'கருத்து','hi'=>'टिप्पणी','zh'=>'评论',
    'ja'=>'コメント','ko'=>'댓글','ar'=>'تعليق','fr'=>'Commentaire','de'=>'Kommentar',
    'es'=>'Comentario','pt'=>'Comentário','ru'=>'Комментарий','it'=>'Commento','tr'=>'Yorum',
    'nl'=>'Reactie','pl'=>'Komentarz','vi'=>'Bình luận','th'=>'ความคิดเห็น',
    'id'=>'Komentar','ms'=>'Komen','fa'=>'نظر','ur'=>'تبصرہ','bn'=>'মন্তব্য','sw'=>'Maoni',
  ],
  'comment_placeholder' => [
    'en'=>'Share your thoughts…','si'=>'ඔබේ අදහස් බෙදාගන්න…','ta'=>'உங்கள் எண்ணங்களை பகிருங்கள்…','hi'=>'अपने विचार साझा करें…','zh'=>'分享您的想法…',
    'ja'=>'ご意見をどうぞ…','ko'=>'생각을 나눠주세요…','ar'=>'شارك أفكارك…','fr'=>'Partagez vos pensées…','de'=>'Teilen Sie Ihre Gedanken…',
    'es'=>'Comparte tus pensamientos…','pt'=>'Compartilhe seus pensamentos…','ru'=>'Поделитесь своими мыслями…','it'=>'Condividi i tuoi pensieri…','tr'=>'Düşüncelerinizi paylaşın…',
    'nl'=>'Deel uw gedachten…','pl'=>'Podziel się swoimi przemyśleniami…','vi'=>'Chia sẻ suy nghĩ của bạn…','th'=>'แบ่งปันความคิดของคุณ…',
    'id'=>'Bagikan pikiran Anda…','ms'=>'Kongsi pemikiran anda…','fa'=>'افکار خود را به اشتراک بگذارید…','ur'=>'اپنے خیالات شیئر کریں…','bn'=>'আপনার ভাবনা শেয়ার করুন…','sw'=>'Shiriki mawazo yako…',
  ],
  'share_article' => [
    'en'=>'Share this article','si'=>'මෙම ලිපිය බෙදාගන්න','ta'=>'இந்த கட்டுரையை பகிரவும்','hi'=>'इस लेख को शेयर करें','zh'=>'分享本文',
    'ja'=>'この記事をシェア','ko'=>'이 기사 공유','ar'=>'شارك هذا المقال','fr'=>'Partager cet article','de'=>'Artikel teilen',
    'es'=>'Compartir este artículo','pt'=>'Compartilhar este artigo','ru'=>'Поделиться статьей','it'=>'Condividi articolo','tr'=>'Makaleyi paylaş',
    'nl'=>'Artikel delen','pl'=>'Udostępnij artykuł','vi'=>'Chia sẻ bài viết','th'=>'แชร์บทความนี้',
    'id'=>'Bagikan artikel ini','ms'=>'Kongsi artikel ini','fa'=>'این مقاله را به اشتراک بگذارید','ur'=>'یہ مضمون شیئر کریں','bn'=>'এই নিবন্ধটি শেয়ার করুন','sw'=>'Shiriki makala hii',
  ],
  'translated_by' => [
    'en'=>'Auto-translated by','si'=>'ස්වයංක්‍රීයව පරිවර්තනය කළේ','ta'=>'தானாக மொழிபெயர்க்கப்பட்டது','hi'=>'स्वतः अनुवादित','zh'=>'自动翻译',
    'ja'=>'自動翻訳','ko'=>'자동 번역','ar'=>'تُرجم تلقائياً بواسطة','fr'=>'Traduit automatiquement par','de'=>'Automatisch übersetzt von',
    'es'=>'Traducido automáticamente por','pt'=>'Traduzido automaticamente por','ru'=>'Автоматически переведено','it'=>'Tradotto automaticamente da','tr'=>'Otomatik çevrildi',
    'nl'=>'Automatisch vertaald door','pl'=>'Automatycznie przetłumaczone przez','vi'=>'Được dịch tự động bởi','th'=>'แปลอัตโนมัติโดย',
    'id'=>'Diterjemahkan otomatis oleh','ms'=>'Diterjemah secara automatik oleh','fa'=>'ترجمه شده توسط','ur'=>'خودکار ترجمہ از','bn'=>'স্বয়ংক্রিয়ভাবে অনুবাদিত','sw'=>'Ilitafsiriwa kiotomatiki na',
  ],
  'read_in_language' => [
    'en'=>'Read this article in your language:','si'=>'මෙම ලිපිය ඔබේ භාෂාවෙන් කියවන්න:','ta'=>'இந்த கட்டுரையை உங்கள் மொழியில் படிக்கவும்:','hi'=>'इस लेख को अपनी भाषा में पढ़ें:','zh'=>'用您的语言阅读本文:',
    'ja'=>'この記事をあなたの言語で読む：','ko'=>'이 기사를 귀하의 언어로 읽기:','ar'=>'اقرأ هذا المقال بلغتك:','fr'=>'Lire cet article dans votre langue:','de'=>'Artikel in Ihrer Sprache lesen:',
    'es'=>'Lee este artículo en tu idioma:','pt'=>'Leia este artigo no seu idioma:','ru'=>'Читать статью на вашем языке:','it'=>'Leggi questo articolo nella tua lingua:','tr'=>'Bu makaleyi kendi dilinizde okuyun:',
    'nl'=>'Lees dit artikel in uw taal:','pl'=>'Przeczytaj artykuł w swoim języku:','vi'=>'Đọc bài viết này bằng ngôn ngữ của bạn:','th'=>'อ่านบทความนี้ในภาษาของคุณ:',
    'id'=>'Baca artikel ini dalam bahasa Anda:','ms'=>'Baca artikel ini dalam bahasa anda:','fa'=>'این مقاله را به زبان خود بخوانید:','ur'=>'یہ مضمون اپنی زبان میں پڑھیں:','bn'=>'এই নিবন্ধটি আপনার ভাষায় পড়ুন:','sw'=>'Soma makala hii kwa lugha yako:',
  ],
  'contributing_writer' => [
    'en'=>'Contributing Writer','si'=>'ලේඛක','ta'=>'பங்களிக்கும் எழுத்தாளர்','hi'=>'योगदान लेखक','zh'=>'特约撰稿人',
    'ja'=>'寄稿者','ko'=>'기고 작가','ar'=>'كاتب مساهم','fr'=>'Rédacteur contributeur','de'=>'Beitragsautor',
    'es'=>'Escritor colaborador','pt'=>'Escritor colaborador','ru'=>'Автор-участник','it'=>'Scrittore collaboratore','tr'=>'Katkıda bulunan yazar',
    'nl'=>'Bijdragende schrijver','pl'=>'Autor zewnętrzny','vi'=>'Tác giả đóng góp','th'=>'นักเขียนผู้มีส่วนร่วม',
    'id'=>'Penulis kontributor','ms'=>'Penulis penyumbang','fa'=>'نویسنده مشارکتی','ur'=>'مددگار مصنف','bn'=>'অবদানকারী লেখক','sw'=>'Mwandishi Mchangiaji',
  ],
  'you_may_like' => [
    'en'=>'You May Like','si'=>'ඔබට කැමති විය හැකිය','ta'=>'நீங்கள் விரும்பலாம்','hi'=>'आपको पसंद आ सकता है','zh'=>'你可能喜欢',
    'ja'=>'おすすめ','ko'=>'좋아할 수도 있어요','ar'=>'قد يعجبك','fr'=>'Vous pourriez aimer','de'=>'Das könnte Ihnen gefallen',
    'es'=>'Te puede gustar','pt'=>'Você pode gostar','ru'=>'Вам может понравиться','it'=>'Potrebbe piacerti','tr'=>'Beğenebilirsiniz',
    'nl'=>'Misschien vind je dit leuk','pl'=>'Może ci się spodobać','vi'=>'Bạn có thể thích','th'=>'คุณอาจจะชอบ',
    'id'=>'Anda mungkin suka','ms'=>'Anda mungkin suka','fa'=>'شاید دوست داشته باشید','ur'=>'آپ کو پسند آ سکتا ہے','bn'=>'আপনি পছন্দ করতে পারেন','sw'=>'Unaweza kupenda',
  ],
  'related_articles' => [
    'en'=>'Related Articles','si'=>'සම්බන්ධ ලිපි','ta'=>'தொடர்புடைய கட்டுரைகள்','hi'=>'संबंधित लेख','zh'=>'相关文章',
    'ja'=>'関連記事','ko'=>'관련 기사','ar'=>'مقالات ذات صلة','fr'=>'Articles connexes','de'=>'Verwandte Artikel',
    'es'=>'Artículos relacionados','pt'=>'Artigos relacionados','ru'=>'Связанные статьи','it'=>'Articoli correlati','tr'=>'İlgili makaleler',
    'nl'=>'Gerelateerde artikelen','pl'=>'Powiązane artykuły','vi'=>'Bài viết liên quan','th'=>'บทความที่เกี่ยวข้อง',
    'id'=>'Artikel terkait','ms'=>'Artikel berkaitan','fa'=>'مقالات مرتبط','ur'=>'متعلقہ مضامین','bn'=>'সম্পর্কিত নিবন্ধ','sw'=>'Makala Zinazohusiana',
  ],
  'more_in' => [
    'en'=>'More in','si'=>'තවත් ','ta'=>'மேலும்','hi'=>'और में','zh'=>'更多关于',
    'ja'=>'もっと見る：','ko'=>'더 보기:','ar'=>'المزيد في','fr'=>'Plus dans','de'=>'Mehr in',
    'es'=>'Más en','pt'=>'Mais em','ru'=>'Больше в','it'=>'Altro in','tr'=>'Daha fazlası:',
    'nl'=>'Meer in','pl'=>'Więcej w','vi'=>'Thêm về','th'=>'เพิ่มเติมใน',
    'id'=>'Lebih banyak di','ms'=>'Lebih banyak dalam','fa'=>'بیشتر در','ur'=>'مزید میں','bn'=>'আরও','sw'=>'Zaidi katika',
  ],
];
