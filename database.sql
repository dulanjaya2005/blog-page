-- ============================================================
-- CharmVibe Blog System — Database Setup
-- Run this file once to initialize all tables + demo data
-- ============================================================

CREATE DATABASE IF NOT EXISTS blog_system
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE blog_system;

-- ─── Users ────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS users (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username   VARCHAR(60)  NOT NULL UNIQUE,
  email      VARCHAR(120) NOT NULL UNIQUE,
  password   VARCHAR(255) NOT NULL,
  created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default admin  password: Admin@1234
INSERT IGNORE INTO users (username, email, password)
VALUES ('admin', 'admin@charmvibe.com',
        '$2y$12$K8pJrQC1o9OdVpUXzZjVMuGZn8mBg3vYdKuJpD7Lz2kDHn1QKt5Yi');

-- ─── Categories ───────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS categories (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(80)  NOT NULL,
  slug       VARCHAR(100) NOT NULL UNIQUE,
  icon       VARCHAR(60)  NOT NULL DEFAULT 'fa-folder',
  created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO categories (name, slug, icon) VALUES
  ('Love',              'love',             'fa-heart'),
  ('Horror',            'horror',           'fa-ghost'),
  ('Mystery',           'mystery',          'fa-magnifying-glass'),
  ('Psychology',        'psychology',       'fa-brain'),
  ('Make Money Online', 'make-money-online','fa-dollar-sign'),
  ('Technology',        'technology',       'fa-microchip');

-- ─── Posts ────────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS posts (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title       VARCHAR(255) NOT NULL,
  slug        VARCHAR(280) NOT NULL UNIQUE,
  content     LONGTEXT     NOT NULL,
  excerpt     TEXT,
  image       VARCHAR(255) DEFAULT NULL,
  category_id INT UNSIGNED NOT NULL,
  author      VARCHAR(80)  NOT NULL DEFAULT 'Admin',
  tags        VARCHAR(255) DEFAULT NULL,
  created_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO posts (title, slug, content, excerpt, image, category_id, author, tags) VALUES
(
  'The Secret Language of Long-Distance Love',
  'secret-language-long-distance-love',
  '<p>Long-distance relationships are one of the most profound tests of modern love. They strip away convenience and comfort, leaving only the raw essence of connection.</p><h2>Why Distance Makes Love Deeper</h2><p>When you cannot be physically present with someone, every word carries amplified weight. A simple "goodnight" text becomes a ritual. A video call becomes an event you dress up for. The everyday moments that couples take for granted become precious ceremonies.</p><p>Psychologists have found that couples in long-distance relationships often communicate more intentionally than those who share the same home. They plan conversations, express needs clearly, and develop extraordinary emotional intelligence simply because they must.</p><h2>The Rituals That Sustain</h2><p>Successful long-distance couples almost universally develop shared rituals — watching the same show simultaneously from different cities, sending voice notes instead of texts, or leaving recorded messages to wake up to. These small acts of synchronicity create the feeling of a shared life despite the miles.</p><p>The key insight that many discover is that love is not primarily a physical sensation but a narrative — a story you both agree to keep telling.</p>',
  'Long-distance relationships strip away convenience, leaving only the raw essence of connection. Discover what research and real couples reveal.',
  NULL, 1, 'Admin', 'love,relationships,long-distance'
),
(
  'The Psychology of Fear: Why We Love Being Scared',
  'psychology-of-fear-why-we-love-being-scared',
  '<p>Horror films gross billions annually. Haunted houses attract millions of visitors. Roller coasters with terrifying drops have waiting lines hours long. Humanity has an unmistakable love affair with fear — but why?</p><h2>The Neuroscience Behind the Thrill</h2><p>When your brain perceives danger, it triggers a cascade of neurochemicals: adrenaline sharpens your senses, dopamine floods your reward pathways, and endorphins create a natural high. The critical element in recreational fear is context — your prefrontal cortex knows you are safe even while your amygdala sounds alarm bells.</p><p>This cognitive dissonance — being scared but knowing you are safe — creates a unique cocktail of sensations that is genuinely pleasurable for many people.</p><h2>The Excitation Transfer Theory</h2><p>Psychologist Dolf Zillmann proposed that residual arousal from one emotional state bleeds into the next. So the racing heart from a terrifying scene transfers into an intensified emotional response — including relief, triumph, and even joy — once the threat passes.</p><p>This is why people laugh immediately after being startled. The body was primed for peak sensation; humor just happened to be the landing pad.</p>',
  'Horror films, haunted houses, roller coasters — humanity loves being scared. Neuroscience reveals the fascinating reason why.',
  NULL, 2, 'Admin', 'horror,psychology,fear,neuroscience'
),
(
  '7 Passive Income Streams That Actually Work in 2025',
  '7-passive-income-streams-that-actually-work-2025',
  '<p>The phrase "passive income" gets thrown around so carelessly that many people have become cynical about it. But real passive income — money that works while you sleep — absolutely exists. The key is understanding what truly passive means and what requires ongoing invisible labor.</p><h2>1. Dividend Investing</h2><p>Owning shares in companies that pay regular dividends is perhaps the most genuinely passive income stream available. Once you build a portfolio, dividends arrive quarterly with zero additional effort. The challenge is capital — you need significant investment to generate meaningful income.</p><h2>2. Digital Product Sales</h2><p>Create once, sell infinitely. Ebooks, Notion templates, Lightroom presets, Figma UI kits — digital products have zero marginal cost after creation. Platforms like Gumroad, Etsy, and your own website can generate sales while you sleep.</p><h2>3. Affiliate Marketing through SEO Content</h2><p>Publishing genuinely useful content that ranks on Google and recommends products you love can generate substantial commissions. The key word is "genuinely" — search engines and readers alike are increasingly sophisticated at detecting hollow content.</p><h2>4. Licensing Your Photography or Music</h2><p>If you create visual or audio content, licensing it through platforms like Shutterstock, Adobe Stock, or Musicbed can generate royalties from each use. One excellent image can earn hundreds of times.</p>',
  'Real passive income exists — but it requires upfront work. Here are 7 streams with honest breakdowns of what each truly requires.',
  NULL, 5, 'Admin', 'passive-income,money,finance,2025'
),
(
  'The Mandela Effect: When Millions Share the Same False Memory',
  'mandela-effect-millions-share-same-false-memory',
  '<p>Nelson Mandela did not die in prison in the 1980s. The Monopoly man does not wear a monocle. Darth Vader says "No, I am your father," not "Luke, I am your father." And yet millions of people vividly remember these things differently — and they are wrong.</p><h2>What Is the Mandela Effect?</h2><p>Named after a widespread false memory of Nelson Mandela dying during imprisonment (he actually died in 2013), the Mandela Effect describes situations where large groups of people share the same incorrect memory. The phenomenon was coined by researcher Fiona Broome in 2009.</p><h2>The Neuroscience of False Memory</h2><p>Memory is not a recording — it is a reconstruction. Every time you recall a memory, you are literally rebuilding it from fragments, and each reconstruction is subject to error, suggestion, and contamination from other information.</p><p>Psychologist Elizabeth Loftus spent decades demonstrating that human memory is astonishingly malleable. In one landmark experiment, she implanted false memories of being lost in a mall as a child in 25% of adult participants — memories they described with rich, confident detail.</p><h2>Why the Same Errors Spread</h2><p>Shared false memories often arise from cultural repetition of incorrect versions. Once a wrong quote or image becomes the dominant cultural representation, it overwrites the accurate memory in millions of minds simultaneously.</p>',
  'Millions of people remember Nelson Mandela dying in prison. He did not. The Mandela Effect reveals something profound about human memory.',
  NULL, 3, 'Admin', 'mystery,memory,psychology,mandela-effect'
),
(
  'Cognitive Biases That Are Costing You Money Every Day',
  'cognitive-biases-costing-you-money-every-day',
  '<p>Your brain is not optimized for the modern economy. Evolutionary pressures shaped a mind exquisitely tuned for immediate physical threats and social dynamics — not compound interest, loss aversion calculations, or sunk cost analysis. The result is a set of cognitive biases that cost the average person thousands of dollars annually.</p><h2>The Sunk Cost Fallacy</h2><p>You continue watching a terrible movie because you paid for the ticket. You stay in a failing business because of past investment. You hold a losing stock hoping to "break even." These are all manifestations of sunk cost thinking — the irrational tendency to factor in unrecoverable past costs when making current decisions.</p><p>Rational decision-making considers only future costs and benefits. What is already spent is gone regardless of your next choice.</p><h2>Present Bias</h2><p>Behavioral economists consistently find that humans dramatically overvalue immediate rewards relative to future ones. Offered $100 today or $110 next week, most people take $100 now. But the same people will choose $110 in 8 weeks over $100 in 7 weeks — even though the time gap is identical.</p><h2>The Anchoring Effect</h2><p>The first number you see in any negotiation or purchase decision becomes an anchor that distorts all subsequent judgment. When a retailer marks an item from $200 down to $120, your brain evaluates the $120 relative to the $200 anchor — not relative to its actual value.</p>',
  'Your brain evolved for a world without credit cards or compound interest. These cognitive biases are silently draining your wealth.',
  NULL, 4, 'Admin', 'psychology,money,cognitive-bias,finance'
),
(
  'AI Is Changing Creativity: Threat or Renaissance?',
  'ai-changing-creativity-threat-or-renaissance',
  '<p>The emergence of generative AI — systems that produce images, text, music, and video — has ignited one of the most consequential debates in the history of art and technology. Is AI the end of human creative expression or the beginning of its most expansive era?</p><h2>The Case for Threat</h2><p>The concern is real and documented. Stock photo agencies have reported significant revenue declines. Certain illustration and concept art commissions have shifted toward AI generation. Voice actors find synthetic voices competing for audiobook narration. These are not abstract fears but measurable economic displacements affecting real people.</p><h2>The Case for Renaissance</h2><p>History suggests a different trajectory. When photography emerged, painters predicted the death of portraiture. Instead, freed from documentation, painting became radically more experimental — Impressionism, Cubism, Expressionism all emerged in the photographic age.</p><p>AI tools are already enabling creators with vision but limited technical execution to realize work that was previously inaccessible to them. Filmmakers prototype entire sequences. Musicians explore sonic territories that would require enormous budgets. Writers rapidly iterate on structural ideas.</p><h2>The Honest Answer</h2><p>Both things are true simultaneously. AI will eliminate certain categories of mechanical creative work while potentially expanding the ceiling of what individual creators can achieve. The critical variable is whether the economic value created flows back to human creators or concentrates in technology companies.</p>',
  'Generative AI is displacing some creative work while potentially enabling unprecedented creative freedom. The honest answer is: both things are true.',
  NULL, 6, 'Admin', 'technology,AI,creativity,art,future'
);

-- ─── Comments ─────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS comments (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  post_id    INT UNSIGNED NOT NULL,
  name       VARCHAR(100) NOT NULL,
  email      VARCHAR(120) DEFAULT NULL,
  comment    TEXT         NOT NULL,
  status     ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO comments (post_id, name, email, comment, status) VALUES
(1, 'Sarah M.', 'sarah@example.com', 'This resonated deeply. Long distance taught me more about love than anything else ever has.', 'approved'),
(1, 'James K.', 'james@example.com', 'The part about rituals is so true. We watch a show together every Friday night even from 5000 miles apart.', 'approved'),
(3, 'Priya R.', 'priya@example.com', 'The digital products section is eye-opening. I sold my first Notion template last week!', 'approved');

-- ─── Contacts ─────────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS contacts (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100) NOT NULL,
  email      VARCHAR(120) NOT NULL,
  subject    VARCHAR(200) DEFAULT NULL,
  message    TEXT         NOT NULL,
  created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;