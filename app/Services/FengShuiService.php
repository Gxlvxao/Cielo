<?php

namespace App\Services;

class FengShuiService
{
    /**
     * Calcula o número Kua e o Elemento baseada na data de nascimento e género.
     * Lógica simplificada para MVP.
     */
    public function calculateProfile(string $birthDate, string $gender): array
    {
        $year = date('Y', strtotime($birthDate));
        
        // Soma dos dígitos do ano até restar um único dígito (ex: 1990 -> 1+9+9+0 = 19 -> 1+9=10 -> 1)
        $sum = $this->reduceYearDigits($year);
        
        $kua = 0;
        
        if ($gender === 'male') {
            $kua = 11 - $sum;
        } else {
            $kua = 4 + $sum;
        }
        
        // Ajustes matemáticos do Kua
        if ($kua > 9) $kua -= 9;
        if ($kua === 0) $kua = 9; // Caso especial
        if ($kua === 5) $kua = ($gender === 'male') ? 2 : 8; // Regra do 5

        return [
            'kua_number' => $kua,
            'element' => $this->getElementByKua($kua),
            'favorable_directions' => $this->getDirections($kua),
            'vibe_tag' => $this->getVibeTag($kua),
        ];
    }

    private function reduceYearDigits($year)
    {
        $sum = array_sum(str_split($year));
        return ($sum > 9) ? $this->reduceYearDigits($sum) : $sum;
    }

    private function getElementByKua($kua)
    {
        $elements = [
            1 => 'Água (Fluidez)',
            2 => 'Terra (Estabilidade)',
            3 => 'Madeira (Crescimento)',
            4 => 'Madeira (Expansão)',
            6 => 'Metal (Foco)',
            7 => 'Metal (Alegria)',
            8 => 'Terra (Sabedoria)',
            9 => 'Fogo (Visibilidade)'
        ];
        return $elements[$kua] ?? 'Desconhecido';
    }

    private function getDirections($kua)
    {
        // Simplificado: Grupos Leste vs Oeste
        $eastGroup = [1, 3, 4, 9];
        return in_array($kua, $eastGroup) 
            ? ['Norte', 'Sul', 'Leste', 'Sudeste'] 
            : ['Oeste', 'Noroeste', 'Sudoeste', 'Nordeste'];
    }
    
    private function getVibeTag($kua)
    {
        $tags = [
            1 => 'O Diplomata Intuitivo',
            2 => 'O Cuidador Resiliente',
            3 => 'O Iniciador Visionário',
            4 => 'O Conector Harmonioso',
            6 => 'O Líder Disciplinado',
            7 => 'O Comunicador Carismático',
            8 => 'O Estrategista Profundo',
            9 => 'O Inspirador Brilhante'
        ];
        return $tags[$kua] ?? 'Explorador';
    }
}