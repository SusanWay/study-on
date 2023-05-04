<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Lesson;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->merge($product);

        $course_1  = new Course();
        $course_1->setCharacterCode('00a1');
        $course_1->setName('Дизайн и UX');
        $course_1->setContent('Графический дизайнер создаёт визуальные концепции брендов — может отрисовать логотип, разработать брендбук, сделать презентацию или макет сайта');
        $course_1->setImage('https://proudalenku.ru/wp-content/uploads/2021/04/art-direktor.png');

        $manager->persist($course_1);
        $manager->flush();
            
        $lesson_1_1 = new Lesson();
        $lesson_1_1->setName('Введение');
        $lesson_1_1->setContent('После обучения вы сможете работать дизайнером в агентствах, крупных компаниях-рекламодателях или на фрилансе. Для этого вы освоите необходимые инструменты, рассмотрите возможные карьерные треки и подготовите портфолио');
        $lesson_1_1->setLessonNumber(1);
        $course_1->addLesson($lesson_1_1);
        

        $lesson_1_2 = new Lesson();
        $lesson_1_2->setName('Основы работы в UX');
        $lesson_1_2->setContent('Научитесь создавать креативный и интуитивно понятный дизайн веб- и мобильных интерфейсов');
        $lesson_1_2->setLessonNumber(2);
        $course_1->addLesson($lesson_1_2);
        

        $lesson_1_3 = new Lesson();
        $lesson_1_3->setName('Чем занимается UX/UI-дизайнер');
        $lesson_1_3->setContent('UX/UI-дизайнер думает за пользователя, анализирует его поведение и создаёт для него удобный и приятный интерфейс. Работа специалиста улучшает взаимодействие человека с продуктом и тем самым увеличивает прибыль бизнеса.');
        $lesson_1_3->setLessonNumber(3);
        $course_1->addLesson($lesson_1_3);
        
        $manager->persist($lesson_1_1);
        $manager->persist($lesson_1_2);
        $manager->persist($lesson_1_3);
        $manager->flush();

        $course_2  = new Course();
        $course_2->setCharacterCode('00с3');
        $course_2->setName('Аналитика');
        $course_2->setContent('Data Scientist с нуля до middle');
        $course_2->setImage('https://indicator.ru/thumb/1360x0/filters:quality(75):no_upscale()/imgs/2019/08/05/10/3484072/07b89c804b86dc2bfbe290bd22a518143fa63b01.jpg');

        $manager->persist($course_2);
        $manager->flush();
        
        $lesson_2_1 = new Lesson();
        $lesson_2_1->setName('Погружение');
        $lesson_2_1->setContent('В первом модуле вы разберётесь, что такое аналитическое мышление, и узнаете, откуда берутся данные. Научитесь определять ключевые продуктовые метрики и создавать дашборды.');
        $lesson_2_1->setLessonNumber(1);
        $course_2->addLesson($lesson_2_1);
        

        $lesson_2_2 = new Lesson();
        $lesson_2_2->setName('СSQL, Python и Big Data');
        $lesson_2_2->setContent('Вы получите ключевые навыки специалиста в Data Science для старта в профессии и сможете искать стажировку в новой сфере уже после прохождения первой ступени.');
        $lesson_2_2->setLessonNumber(2);
        $course_2->addLesson($lesson_2_2);
        

        $lesson_2_3 = new Lesson();
        $lesson_2_3->setName('Машинное обучение, Deep Learning и нейронные сети');
        $lesson_2_3->setContent('Получите расширенные знания в профессии и научитесь работать с нейронным сетями, обучать модели и реализовывать NLP. Начнёте повышать свою квалификацию. После окончания этой ступени сможете претендовать на позицию Junior Data Scientist и совмещать учёбу с работой.');
        $lesson_2_3->setLessonNumber(3);
        $course_2->addLesson($lesson_2_3);
        
        $manager->persist($lesson_2_1);
        $manager->persist($lesson_2_2);
        $manager->persist($lesson_2_3);
        $manager->flush();

        $course_3  = new Course();
        $course_3->setCharacterCode('032v');
        $course_3->setName('Тестировщик');
        $course_3->setContent('Вы освоите язык запросов SQL и его процедурное расширение PL/SQL. Научитесь собирать, обрабатывать и предоставлять данные для анализа, сможете визуализировать информацию и поймёте, как использовать и настраивать свои базы данных для различных задач.');
        $course_3->setImage('https://sky.pro/media/wp-content/uploads/2022/07/glavnaya-3.png');

        $manager->persist($course_3);
        $manager->flush();
        
        $lesson_3_1 = new Lesson();
        $lesson_3_1->setName('Ручное тестирование веб-приложений');
        $lesson_3_1->setContent('Начнём с азов проведения тестирования и введения в профессию. За 8 занятий вы познакомитесь с теориями тестирования, узнаете разницу между понятиями QA и тестированием и начнёте писать тестовые сценарии и заводить баги. На практике вы будете работать с различными программными продуктами, создавать под них тестовые сценарии и заводить баги на платформе JIRA, а также тестировать API.');
        $lesson_3_1->setLessonNumber(1);
        $course_3->addLesson($lesson_3_1);
        
        $lesson_3_2 = new Lesson();
        $lesson_3_2->setName('Java для тестировщиков');
        $lesson_3_2->setContent('В этом блоке начинаем работу с Java, одним из самых популярных языков программирования. Блок состоит из 16 занятий и включает в себя изучение основ языка, работу с объектно-ориентированным программированием, сборку Java проектов и использование инструментов тестирования. Вы изучите язык программирования именно в связке с задачами тестирования. ');
        $lesson_3_2->setLessonNumber(2);
        $course_3->addLesson($lesson_3_2);
        
        $lesson_3_3 = new Lesson();
        $lesson_3_3->setName('Вёрстка сайта на HTML и CSS');
        $lesson_3_3->setContent('Научитесь верстать сайты на HTML и CSS и вносить изменения в существующую вёрстку. По итогам модуля вы сможете самостоятельно сверстать лендинг.');
        $lesson_3_3->setLessonNumber(3);
        $course_3->addLesson($lesson_3_3);
        
        $lesson_3_4 = new Lesson();
        $lesson_3_4->setName('Git — система контроля версий');
        $lesson_3_4->setContent('Каждый разработчик должен знать основы работы с системой Git, так как на данный момент это практически стандарт по управлению исходным кодом. За 3 занятия вы научитесь работать с этой системой и с сервисом GitHub, сможете публиковать свои домашние работы и уже в процессе обучения сформируете первое портфолио (работодатели часто просят показать примеры вашего кода на GitHub).');
        $lesson_3_4->setLessonNumber(4);
        $course_3->addLesson($lesson_3_4);

        $manager->persist($lesson_3_1);
        $manager->persist($lesson_3_2);
        $manager->persist($lesson_3_3);
        $manager->persist($lesson_3_4);
        $manager->flush();

        $course_4  = new Course();
        $course_4->setCharacterCode('032у');
        $course_4->setName('Фотограф');
        $course_4->setContent('Вы с нуля научитесь делать профессиональные фото. Узнаете, как организовывать съёмки, обрабатывать кадры, руководить моделями и командой. Сможете найти свой стиль, собрать впечатляющее портфолио и начать зарабатывать на любимом деле.');
        $course_4->setImage('https://img.freepik.com/free-vector/pop-art-fashion-and-beautiful-woman-cartoon_18591-52393.jpg?w=360');

        $manager->persist($course_4);
        $manager->flush();
            
        $lesson_4_1 = new Lesson();
        $lesson_4_1->setName('Создание цепляющих кадров');
        $lesson_4_1->setContent('Узнаете, как выстроить композицию в кадре, найти акценты и выбрать ракурс. Разовьёте насмотренность и научитесь делать запоминающиеся фото.');
        $lesson_4_1->setLessonNumber(1);
        $course_4->addLesson($lesson_4_1);
        

        $lesson_4_2 = new Lesson();
        $lesson_4_2->setName('Выставление света');
        $lesson_4_2->setContent('Сможете настраивать свет на площадке, работать с разными источниками освещения и использовать креативные приёмы. Научитесь делать качественные снимки в любых условиях.');
        $lesson_4_2->setLessonNumber(2);
        $course_4->addLesson($lesson_4_2);
        

        $lesson_4_3 = new Lesson();
        $lesson_4_3->setName('Работать с клиентами');
        $lesson_4_3->setContent('Узнаете, как создать личный бренд и портфолио. Научитесь работать с клиентами и разберётесь в юридических нюансах.');
        $lesson_4_3->setLessonNumber(3);
        $course_4->addLesson($lesson_4_3);
        
        $manager->persist($lesson_4_1);
        $manager->persist($lesson_4_2);
        $manager->persist($lesson_4_3);
        $manager->flush();


        $course_5  = new Course();
        $course_5->setCharacterCode('0а2у');
        $course_5->setName('Режиссёр монтажа');
        $course_5->setContent('Научитесь профессионально монтировать клипы, фильмы, рекламные ролики и репортажи.');
        $course_5->setImage('https://aflife.ru/wp-content/uploads/2020/12/obyazannosti-montazhera-i-nuzhnye-dlya-raboty-navyki.jpg');

        $manager->persist($course_5);
        $manager->flush();
            
        $lesson_5_1 = new Lesson();
        $lesson_5_1->setName('Работата в Adobe Premiere Pro');
        $lesson_5_1->setContent('Сможете собирать видео из нескольких роликов, корректировать цвет и стабилизировать изображение, добавлять титры и работать с мультикамерой.');
        $lesson_5_1->setLessonNumber(1);
        $course_5->addLesson($lesson_5_1);
        

        $lesson_5_2 = new Lesson();
        $lesson_5_2->setName('Создание эффектов и анимации');
        $lesson_5_2->setContent('Познакомитесь с Adobe After Effects, научитесь дополнять видео эффектами, анимировать текст и фотографии. Поймёте, как стилизовать видео и сделать его оригинальным.');
        $lesson_5_2->setLessonNumber(2);
        $course_5->addLesson($lesson_5_2);
        

        $lesson_5_3 = new Lesson();
        $lesson_5_3->setName('Написание сценария');
        $lesson_5_3->setContent('Изучите основы драматургии и сценарного мастерства. Научитесь создавать увлекательные истории и удерживать внимание зрителя.');
        $lesson_5_3->setLessonNumber(3);
        $course_5->addLesson($lesson_5_3);
        
        $manager->persist($lesson_5_1);
        $manager->persist($lesson_5_2);
        $manager->persist($lesson_5_3);
        $manager->flush();
    }
}
