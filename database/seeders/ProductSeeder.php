<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Consultoria, Apoio Técnico e Equipamentos',
                'description' => 'Prestamos consultorias e assessorias técnicas e empresariais em diversas áreas. Oferecemos também assistência técnica especializada e aluguer de equipamentos para garantir que os seus projectos não parem. Quer esteja a começar ou a expandir, temos os recursos e o know-how de que precisa.',
                'price' => 20000.00,
                'image' => 'products/RDObFdOpdcYcgR9Gv6sFwMutwBmbyI8mnmUe63wc.jpg',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Jogos, Eventos e Entretenimento',
                'description' => 'O Grupo Macro oferece serviços na área da organização de jogos sociais, rifas, totobolas, totolotos e jogos em casinos, sempre dentro do que a lei permite. Além disso, somos especialistas na realização de eventos e promoção de espectáculos, proporcionando experiências únicas com profissionalismo, segurança e inovação.',
                'price' => 25000.00,
                'image' => 'products/e1KZrpVwp2RsuTNxlNSNzXDEnbfEjYWSBvARf1vW.webp',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Marketing e Comunicação',
                'description' => 'O nosso serviço de marketing e relações públicas é focado em posicionar marcas, produtos e serviços com impacto. Criamos campanhas criativas, eficazes e alinhadas com os objectivos do seu negócio. Atuamos desde a estratégia até à execução.',
                'price' => 12000.00,
                'image' => 'products/KonFjjbWAQpfjmXXf2fW5PcrPnL9ySgHFS620kiD.webp',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Serviços Administrativos e Financeiros',
                'description' => 'O Grupo Macro fornece soluções administrativas, de contabilidade, auditoria e gestão de negócios e financeiras. Prestamos ainda serviços de microcrédito, apoio bancário, mediação e intermediação comercial. Apoiamos a estrutura interna da sua empresa com profissionalismo e confiança.',
                'price' => 9000.00,
                'image' => 'products/zO1xYqB8vW4JFTU4iU9vkvKEqe25yMQlgvtc9WoV.jpg',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Assessoria de viagem',
                'description' => 'A nossa agência surge no mercado de viagens e turismo com o objectivo de oferecer soluções práticas e acessíveis para reservas, emissões de passagens, tickets eletrónicos e pacotes turísticos.

Acreditamos que associar-se à Macro Travel na gestão das suas viagens é sinónimo de praticidade, segurança e tranquilidade, garantido por nossa dedicação à excelência no atendimento.',
                'price' => 7500.00,
                'image' => 'products/Lkyk1ilIdtB6Ze1Wn1QALWZmgDHa5qlkCGbD83xl.webp',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Saúde e Segurança',
                'description' => 'Prestamos serviços de saúde, assistência médica em situações de emergência, segurança pessoal e soluções de segurança electrónica. Trabalhamos com equipas qualificadas e tecnologias avançadas para garantir tranquilidade a pessoas e empresas.

Serviços de saúde
Emergências médicas
Segurança pessoal e electrónica',
                'price' => 23000.00,
                'image' => 'products/HD72h0sElI3pKU3m631sqZQC9RMWiwomy16LdcmR.webp',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Apoio ao Cidadão',
                'description' => 'Dispomos de serviços como restauração, rent-a-car, fotocópias, encadernação, internet-café, montagem e assistência de computadores. São soluções práticas, fiáveis e acessíveis, ideais para empresas e particulares.',
                'price' => 70000.00,
                'image' => 'products/9uV9YWYOCEOuvdQVMRE6nikxkiB35f6RdIPf2bQk.jpg',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
