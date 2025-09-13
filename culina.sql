-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2025 at 11:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `culina`
--

-- --------------------------------------------------------

--
-- Table structure for table `healthy`
--

CREATE TABLE `healthy` (
  `idresep` int(4) NOT NULL,
  `foto` text NOT NULL,
  `namaresep` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `healthy`
--

INSERT INTO `healthy` (`idresep`, `foto`, `namaresep`) VALUES
(1, 'salad.jpg', 'Summer Salad');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(4) NOT NULL,
  `namakategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `namakategori`) VALUES
(1, 'Healthy Food'),
(2, 'Asian Food'),
(3, 'Western Food'),
(4, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `mealplan`
--

CREATE TABLE `mealplan` (
  `idresep` int(4) NOT NULL,
  `namaresep` varchar(100) NOT NULL,
  `namakategori` varchar(50) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mealplan`
--

INSERT INTO `mealplan` (`idresep`, `namaresep`, `namakategori`, `hari`, `foto`) VALUES
(5, 'Chicken Katsu Curry', 'Asian Food', 'Friday', 'chickenkatsu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`email`, `username`, `password`) VALUES
('felicia@gmail.com', 'felicia', '12345'),
('123@gmail.com', 'lavis', '12345'),
('tes', 'tes', '123'),
('vanessa@gmail.com', 'tes1', '123'),
('vaness.siem@gmail.com', 'vanessa', '12345'),
('1234@gmail.com', 'vanessa1', '123');

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `id` int(4) NOT NULL,
  `foto` text NOT NULL,
  `namaresep` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekomendasi`
--

INSERT INTO `rekomendasi` (`id`, `foto`, `namaresep`) VALUES
(1, 'salad.jpg', 'Summer Salad'),
(2, 'chickenpasta.jpg', 'Chicken Pasta Bake'),
(5, 'chickenkatsu.jpg', 'Chicken Katsu Curry'),
(6, 'creamy.jpg', 'Creamy Chicken Pasta');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `idresep` int(4) NOT NULL,
  `foto` text NOT NULL,
  `namakategori` varchar(50) NOT NULL,
  `namaresep` varchar(100) NOT NULL,
  `durasi` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `bahan` text NOT NULL,
  `steps` text NOT NULL,
  `nutrisi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`idresep`, `foto`, `namakategori`, `namaresep`, `durasi`, `deskripsi`, `bahan`, `steps`, `nutrisi`) VALUES
(1, 'salad.jpg', 'Healthy Food', 'Summer Salad', '10 Minutes', 'Perfect for BBQs and buffets, our epic salad is an assembly job of gorgeous ingredients – no cooking required.', '400g black beans drained\r\n2 large handfuls baby spinach leaves roughly chopped\r\n500g heritage tomatoes chopped into large chunks\r\n½ cucumber halved lengthways, seeds scooped out and sliced on an angle\r\n1 mango peeled and chopped into chunks\r\n1 large red onion halved and finely sliced\r\n6-8 radishes sliced\r\n2 avocados peeled and sliced\r\n100g feta\r\ncrumbled handful of herbs (reserved from the dressing)\r\n\r\nFor the dressing\r\nlarge bunch mint\r\nsmall bunch coriander\r\nsmall bunch basil\r\n1 fat green chilli deseeded and chopped\r\n1 small garlic clove\r\n100ml extra virgin olive oil/ rapeseed oil\r\n2 limes zested and juiced\r\n2 tbsp white wine vinegar\r\n2 tsp honey\r\n', 'Step 1\r\nMake the dressing by blending all of the ingredients in a food processor (or very finely chop them),\r\nsaving a few herb leaves for the salad.\r\nYou can make the dressing up to 24 hrs before serving.\r\n\r\nStep 2\r\nScatter the beans and spinach over a large platter.\r\nArrange the tomatoes, cucumber, mango, onion and radishes on top and gently toss together with your hands.\r\nTop the salad with the avocados, feta and herbs, and serve the dressing on the side.\r\n', 'Kcal 392\r\nFat 30g\r\nSaturates 5g\r\nCarbs 18g\r\nSugars 12g\r\nFibre 7g\r\nProtein 8g\r\nSalt 0.6g\r\n'),
(2, 'chickenpasta.jpg', 'Western Food', 'Chicken Pasta Bake', '45 Minutes', 'Enjoy this gooey cheese and chicken pasta bake for the ultimate weekday family dinner. Serve straight from the dish with a dressed green salad.', '4 tbsp olive oil\r\n1 onion\r\nfinely chopped\r\n2 garlic cloves\r\ncrushed\r\n¼ tsp chilli flakes\r\n2 x 400g cans chopped tomatoes\r\n1 tsp caster sugar\r\n6 tbsp mascarpone\r\n4 skinless chicken\r\nbreasts, sliced into strips\r\n300g penne\r\n70g mature cheddar\r\ngrated\r\n50g grated mozzarella\r\n½ small bunch of parsley\r\nfinely chopped', 'Step 1\r\nHeat 2 tbsp of the oil in a pan over a medium heat and fry the onion gently for 10-12 mins.\r\nAdd the garlic and chilli flakes and cook for 1 min. Tip in the tomatoes and sugar and season to taste.\r\nSimmer uncovered for 20 mins or until thickened, then stir through the mascarpone.\r\n\r\nStep 2\r\nHeat 1 tbsp of oil in a non-stick frying pan. Season the chicken and fry for 5-7 mins or until the chicken is cooked through.\r\n\r\nStep 3\r\nHeat the oven to 220C/200C fan/gas 7. Cook the penne following pack instructions. Drain and toss with the remaining oil.\r\nTip the pasta into a medium sized ovenproof dish. Stir in the chicken and pour over the sauce.\r\nTop with the cheddar, mozzarella and parsley. Bake for 20 mins or until golden brown and bubbling.', 'Kcal 575\r\nFat 30g\r\nSaturates 14g\r\nCarbs 41g\r\nSugars 9g\r\nFibre 5g\r\nProtein 33g\r\nSalt 0.5g'),
(3, 'nood.jpg', 'Asian Food', 'Chicken Noodle Soup', '30 Minutes', 'This aromatic broth will warm you up on a winter\'s evening - it contains ginger, which is particularly good for colds.\r\n', '900ml chicken or vegetable stock\r\n1 boneless, skinless chicken breast\r\n1 tsp chopped fresh ginger\r\n1 garlic clove finely chopped\r\n50g rice or wheat noodles\r\n2 tbsp sweetcorn canned or frozen\r\n2-3 mushrooms thinly sliced\r\n2 spring onions shredded\r\n2 tsp soy sauce\r\nbasil leaves and a little shredded chilli (optional), to serve\r\n', 'Step 1\r\nPour the stock into a pan and add the chicken breast, ginger and garlic. Bring to the boil, then reduce the heat,\r\npartly cover and simmer for 20 mins, until the chicken is tender.\r\n\r\nStep 2\r\nPut the chicken on a board and shred into bite-size pieces using a couple of forks. Return the chicken to the stock with the noodles,\r\nsweetcorn, mushrooms, spring onion and soy sauce. Simmer for 3-4 mins until the noodles are tender.\r\n\r\nStep 3\r\nLadle into two bowls and scatter over the remaining spring onion, mint or basil leaves and chilli, if using. Serve with extra soy sauce.\r\n', 'Kcal 266\r\nFat 2g\r\nSaturates 0.4g\r\nCarbs 26g\r\nSugars 3g\r\nFibre 3g\r\nProtein 34g\r\nSalt 3.2g\r\n'),
(4, 'nasgor new.jpg', 'Asian Food', 'Quick & Spicy Nasi Goreng', '10 Minutes', 'Save on the washing up with this speedy supper for one, with wholesome ingredients like Chinese cabbage and brown rice, finished with a fried egg.', '2 tbsp vegetable oil\r\n1 small onion finely sliced\r\n2 garlic cloves crushed\r\n1 carrot grated\r\n½ small Chinese or Savoy cabbage shredded\r\n175g cooked brown rice\r\n1 tbsp fish sauce\r\n(optional)\r\n1 tbsp soy sauce\r\n1 egg\r\nhot siracha\r\nchilli sauce, to serve\r\n', 'Step 1\r\nHeat the oil in a wok over a high heat. Add the onion and cook for 3-4 mins until softened and slightly caramelised.\r\nAdd the garlic and stir for 1 min.\r\n\r\nStep 2\r\nToss in the carrot and cabbage, then cook for 1-2 mins. Add the rice and stir to warm through.\r\nPour in the fish sauce, soy sauce and some seasoning. Make a well in the center of the wok and crack in the egg. Fry until the white is nearly set.\r\n\r\nStep 3\r\nServe the rice in a large bowl, topped with the fried egg and drizzled with chilli sauce.\r\n', 'Kcal 540\r\nFat 30g\r\nSaturates 5g\r\nCarbs 47g\r\nSugars 11g\r\nFibre 9g\r\nProtein 17g\r\nSalt 6.4g\r\n'),
(5, 'chickenkatsu.jpg', 'Asian Food', 'Chicken Katsu Curry', '35 Minutes', 'This healthier katsu is coated in finely chopped flaked almonds and baked in the oven (rather than fried) until crisp and golden.', '25g flaked almonds\r\n1 tsp cold-pressed rapeseed oil\r\n2 boneless, skinless chicken breasts\r\nFor the sauce\r\n2 tsp cold-pressed rapeseed oil\r\n1 medium onion roughly chopped\r\n2 garlic cloves finely chopped\r\nthumb-sized piece ginger peeled and finely chopped\r\n2 tsp medium curry powder\r\n1 star anise\r\n¼ tsp ground turmeric\r\n1 tbsp plain wholemeal flour\r\nFor the rice\r\n100g long-grain brown rice\r\n2 spring onions finely sliced\r\nFor the salad\r\n1 medium carrot peeled into long strips\r\n⅓ cucumber peeled into long strips\r\n1 small red chilli finely chopped\r\njuice ½ lime\r\nsmall handful mint leaves\r\nsmall handful coriander leaves\r\n', 'Step 1\r\nHeat oven to 220C/200C fan/gas 7, or if using an air-fryer, heat to 180C for 4 mins. Cook the brown rice in plenty of boiling water for 35 mins or until tender.\r\n\r\nStep 2\r\nCrush the almonds using a pestle and mortar, or blitz in a food processor until finely chopped, then sprinkle over a plate.\r\nGrease a small baking tray with a little of the oil if baking in the oven. Brush the chicken on both sides with the remaining oil and season well.\r\nCoat the chicken with the nuts and place on the tray. Press any remaining nuts from the plate onto each breast.\r\nBake for 20 mins in the oven, or 18-20 mins in the air-fryer until browned and cooked through. Rest for 4-5 mins on the tray, then slice thickly.\r\n\r\nStep 3\r\nMeanwhile, make the sauce. Heat the oil in a medium non-stick saucepan and add the onion, garlic and ginger.\r\nLoosely cover the pan and fry gently for 8 mins or until softened and lightly browned, stirring occasionally.\r\nRemove the lid for the final 2 mins, and don’t let the garlic burn.\r\n\r\nStep 4\r\nStir in the curry powder, star anise, turmeric and a good grinding of black pepper. Cook for a few secs more, stirring.\r\nSprinkle over the flour and stir well. Gradually add 400ml water to the pan, stirring constantly.\r\n\r\nStep 5\r\nBring the sauce to a simmer and cook for 10 mins, stirring occasionally. If it begins to splutter, cover loosely with a lid.\r\nRemove the pan from the heat and blitz the sauce with a stick blender until smooth. Adjust the seasoning to taste. Keep warm.\r\n\r\nStep 6\r\nOnce the rice is tender, add the spring onions and cook for 1 min more. Drain well, then leave to stand for a few mins while you make the salad.\r\nToss the carrot and cucumber with the chilli, lime juice and herbs.\r\n\r\nStep 7\r\nDivide the sliced chicken between two plates, pour over the sauce and serve with the rice, salad and lime wedges for squeezing over.\r\n', 'Kcal 585\r\nFat 16g\r\nSaturates 2g\r\nCarbs 58g\r\nSugars 12g\r\nFibre 9g\r\nProtein 47g\r\nSalt 0.3g\r\n'),
(6, 'creamy.jpg', 'Western Food', 'Creamy Chicken Pasta', '15 Minutes', 'Try our crowd-pleasing creamy chicken pasta for your next family meal. It\'s packed with flavour and is easy for anyone to make, including children\r\n', '300g dried penne\r\n2 tsp olive oil\r\n1 garlic clove crushed\r\n75g baby spinach leaves\r\n250g soft cheese\r\n25g parmesan\r\n4 cooked chicken breasts, shredded with a fork\r\n100g frozen peas\r\nsmall bunch of parsley or basil, chopped\r\n', 'Step 1\r\nCook the pasta following pack instructions. Reserve 100ml of the water and drain the pasta in a colander.\r\n\r\nStep 2\r\nMeanwhile, heat the oil in a frying pan on a medium heat and fry the garlic and spinach for 3 mins until wilted.\r\nAdd the soft cheese and heat until melted. Stir in most of the parmesan, then add the shredded chicken, peas and some of the pasta water.\r\nBring to the boil and bubble for 2-3 mins until the chicken and peas are completely heated through.\r\n\r\nStep 3\r\nAdd the pasta and stir until combined. Add more pasta water to loosen the sauce, if needed.\r\nRemove from heat, sprinkle over the remaining parmesan and parsley or basil to serve.\r\n', 'Kcal 668\r\nFat 24g\r\nSaturates 13g\r\nCarbs 59g\r\nSugars 5g\r\nFibre 6g\r\nProtein 51g\r\nSalt 0.7g\r\n'),
(7, 'wrap.jpg', 'Others', 'Spicy Chicken & Avocado Wraps', '8 Minutes', 'Pan-fry lean chicken breast with lime, chilli and garlic, then pile onto seeded tortilla wraps', '1 chicken breast thinly sliced at an angle\r\ngenerous squeeze juice 0.5 lime\r\n½ tsp mild chilli powder\r\n1 garlic clove chopped\r\n1 tsp olive oil\r\n2 seeded wraps\r\n1 avocado halved and stoned\r\n1 roasted red pepper from a jar, sliced\r\na few sprigs\r\ncoriander chopped\r\n', 'Step 1\r\nMix the chicken with the lime juice, chilli powder and garlic.\r\n\r\nStep 2\r\nHeat the oil in a non-stick frying pan then fry the chicken for a couple of mins – it will cook very quickly so keep an eye on it.\r\nMeanwhile, warm the wraps following the pack instructions or, if you have a gas hob, heat them over the flame to slightly char them.\r\nDo not let them dry out or they are difficult to roll.\r\n\r\nStep 3\r\nSquash half an avocado onto each wrap, add the peppers to the pan to warm them through then pile onto the wraps with the chicken,\r\nand sprinkle over the coriander. Roll up, cut in half and eat with your fingers.\r\n', 'Kcal 403\r\nFat 16g\r\nSaturates 4g\r\nCarbs 32g\r\nSugars 2g\r\nFibre 5g\r\nProtein 29g\r\nSalt 0.8g\r\n'),
(8, 'blueberry.jpg', 'Healthy Food', 'Blueberry Baked Oats', '35 Minutes', 'Swap your regular porridge for a healthy baked version, packed with oats, juicy blueberries and crunchy almonds.', '500ml almond milk\r\n200g jumbo porridge oats\r\n2 tbsp almond butter\r\n1 tsp baking powder\r\n1 egg beaten\r\n1 small ripe banana mashed\r\n½ tsp almond extract (optional)\r\n450g blueberries plus extra to serve\r\n30g whole, skin-on almonds roughly chopped\r\nmilk or fat-free yogurt and honey, to serve (optional)', 'Step 1\r\nHeat the oven to 200C/180C fan/gas 6. Mix all of the ingredients together in a large bowl.\r\n\r\nStep 2\r\nTip the mixture into a 2-litre ovenproof dish, then bake for 30-35 mins until piping hot in the middle.\r\nServe warm with a little milk or yogurt, honey and extra blueberries, if you like.', 'Kcal 271\r\nFat 11g\r\nSaturates 1g\r\nCarbs 34g\r\nSugars 10g\r\nFibre 6g\r\nProtein 10g\r\nSalt 0.35g');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `usernameid` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`usernameid`, `pass`) VALUES
('felicia', '12345'),
('lavis', '12345'),
('tes', '123'),
('tes1', '123'),
('vanessa', '12345'),
('vanessa1', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `healthy`
--
ALTER TABLE `healthy`
  ADD PRIMARY KEY (`idresep`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mealplan`
--
ALTER TABLE `mealplan`
  ADD UNIQUE KEY `hari` (`hari`),
  ADD UNIQUE KEY `hari_2` (`hari`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`idresep`),
  ADD KEY `namakategori` (`namakategori`),
  ADD KEY `namakategori_2` (`namakategori`),
  ADD KEY `namaresep` (`namaresep`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usernameid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
